<?php

namespace Dashifen\Dashifen2022\Repositories;

use Dashifen\Repository\Repository;
use Timber\MenuItem as TimberMenuItem;
use Dashifen\Repository\RepositoryException;

/**
 * @property-read array  $classes
 * @property-read array  $children
 * @property-read bool   $current
 * @property-read string $label
 * @property-read string $url
 */
class MenuItem extends Repository
{
  protected array $classes = [];
  protected array $children = [];
  protected bool $current;
  protected string $label;
  protected string $url;
  
  public function __construct(object $item)
  {
    $data = $item instanceof TimberMenuItem
      ? $this->extractFromTimberMenuItem($item)
      : (array) $item;
    
    parent::__construct($data);
  }
  
  /**
   * extractFromTimberMenuItem
   *
   * Grabs the pertinent information for this object from the TimberMenuItem
   * that we were provided.
   *
   * @param TimberMenuItem $item
   *
   * @return array
   * @throws RepositoryException
   */
  private function extractFromTimberMenuItem(TimberMenuItem $item): array
  {
    return [
      'classes'  => array_filter($item->classes),
      'children' => array_map(fn($child) => new MenuItem($child), $item->children),
      'current'  => $item->current || $item->current_item_ancestor || $item->current_item_parent,
      'label'    => $item->name(),
      'url'      => $item->url,
    ];
  }
  
  /**
   * setClasses
   *
   * Sets the classes property.
   *
   * @param array $classes
   *
   * @return void
   */
  protected function setClasses(array $classes): void
  {
    // if there have been previously set classes, we don't want to obliterate
    // them with a simple assignment here.  instead, we merge anything that was
    // already added to this item's classes with the new information that we've
    // received this time.
    
    $this->classes = array_merge($this->classes, $classes);
    sort($this->classes);
  }
  
  /**
   * setChildren
   *
   * Sets the children property after confirming that all values in the
   * parameter array are instances of this class.
   *
   * @param MenuItem[] $children
   *
   * @throws RepositoryException
   */
  protected function setChildren(array $children): void
  {
    foreach ($children as $child) {
      if (!($child instanceof MenuItem)) {
        throw new RepositoryException('Children must be MenuItems.',
          RepositoryException::INVALID_VALUE);
      }
    }
    
    $this->children = $children;
  }
  
  /**
   * setCurrent
   *
   * Sets the current property.
   *
   * @param bool $current
   *
   * @return void
   */
  protected function setCurrent(bool $current): void
  {
    $this->current = $current;
    
    // in addition to remembering our Boolean in case it's handy on the
    // server side, for the client side we want to add a class to each menu
    // item so that they can get different styles as needed.
    
    $currentClass = $current ? 'is-current' : 'is-not-current';
    $this->setClasses([$currentClass]);
  }
  
  /**
   * setUrl
   *
   * Sets the url property.
   *
   * @param string $url
   *
   * @return void
   * @throws RepositoryException
   */
  protected function setUrl(string $url): void
  {
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
      throw new RepositoryException('Invalid url: ' . $url,
        RepositoryException::INVALID_VALUE);
    }
    
    $this->url = $url;
  }
  
  /**
   * setLabel
   *
   * Sets the label property.
   *
   * @param string $label
   *
   * @return void
   */
  protected function setLabel(string $label): void
  {
    $this->label = $label;
  }
}

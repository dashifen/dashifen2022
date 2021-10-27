<?php

namespace Dashifen\Dashifen2022;

use Twig\Error\LoaderError;
use Twig\Loader\FilesystemLoader;
use Dashifen\WPHandler\Handlers\HandlerException;
use Dashifen\WPHandler\Handlers\Themes\AbstractThemeHandler;

class Theme extends AbstractThemeHandler
{
  public const SLUG = 'dashifen2022';
  
  /**
   * initialize
   *
   * Uses addAction and/or addFilter to attach protected methods of this object
   * to the ecosystem of WordPress action and filter hooks.
   *
   * @return void
   * @throws HandlerException
   */
  public function initialize(): void
  {
    if (!$this->isInitialized()) {
      $this->addFilter('timber/loader/loader', 'addTimberNamespaces');
      $this->addAction('wp_enqueue_scripts', 'addAssets');
      $this->addAction('after_setup_theme', 'prepareTheme');
    }
  }
  
  /**
   * addTimberNamespaces
   *
   * Adds the namespaces we use within our twig files to the Timber loader
   * so that it can correctly compile our templates.
   *
   * @param FilesystemLoader $loader
   *
   * @return FilesystemLoader
   * @throws LoaderError
   */
  protected function addTimberNamespaces(FilesystemLoader $loader): FilesystemLoader
  {
    $dir = $this->getStylesheetDir() . '/assets/twigs';
    $folders = array_filter(glob($dir . '/*'), 'is_dir');
    
    foreach ($folders as $folder) {
      $namespaces = explode('/', $folder);
      $namespace = array_pop($namespaces);
      $loader->addPath($folder, $namespace);
    }
    
    return $loader;
  }
  
  /**
   * addAssets
   *
   * Adds the script and style assets for this theme into the WordPress
   * assets queue.
   *
   * @return void
   */
  protected function addAssets(): void
  {
    $this->enqueue('assets/dashifen-2022.js');
    $font1 = $this->enqueue('//fonts.googleapis.com/css2?family=El+Messiri&display=swap');
    $font2 = $this->enqueue('//fonts.googleapis.com/css2?family=Roboto&display=swap');
    $css = $this->enqueue('assets/dashifen-2022.css', [$font1, $font2]);
    
    $dir = trailingslashit($this->getStylesheetDir());
    if (file_exists($dir . 'assets/dashifen-2022-components.css')) {
      $this->enqueue('assets/dashifen-2022-components.css', [$css]);
    }
  }
  
  /**
   * prepareTheme
   *
   * Prepares the theme by specifying what it supports and adding menus.
   *
   * @return void
   */
  protected function prepareTheme(): void
  {
    register_nav_menus([
      'main'   => 'Main Menu',
      'footer' => 'Footer Menu',
    ]);
    
    add_theme_support('post-thumbnails', get_post_types(['public' => true]));
  }
}

<?php

namespace Dashifen\Dashifen2022\Templates\Framework;

use Timber\Timber;
use RegexIterator;
use FilesystemIterator;
use Timber\Menu as TimberMenu;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Dashifen\Dashifen2022\Theme;
use Dashifen\Repository\RepositoryException;
use Dashifen\Transformer\TransformerException;
use Dashifen\Dashifen2022\Repositories\MenuItem;
use Dashifen\WPHandler\Handlers\HandlerException;
use Dashifen\WPHandler\Traits\OptionsManagementTrait;
use Dashifen\WPTemplates\AbstractTemplate as AbstractTimberTemplate;

abstract class AbstractTemplate extends AbstractTimberTemplate
{
  use OptionsManagementTrait;
  
  protected int $postId;
  protected array $twigs;
  
  /**
   * AbstractTemplate constructor.
   *
   * @throws HandlerException
   * @throws RepositoryException
   * @throws TemplateException
   * @throws TransformerException
   */
  public function __construct()
  {
    $this->postId = get_the_ID();
    
    try {
      $twig = $this->getTwig();
      $context = $this->getContext();
      parent::__construct($twig, $context);
    } catch (\Dashifen\WPTemplates\TemplateException $e) {
      
      // we catch the baseline template exception object here and "convert" it
      // to a TemplateException for this theme itself.  yes, it's weird that
      // these two objects are named the same, but that's what makes
      // namespacing so nifty!
      
      throw new TemplateException(
        $e->getMessage(),
        $e->getCode(),
        $e
      );
    }
  }
  
  /**
   * getTwig
   *
   * Returns the twig file for this  template after confirming that it exists
   * within this theme.
   *
   * @return string
   * @throws HandlerException
   * @throws TemplateException
   * @throws TransformerException
   */
  private function getTwig(): string
  {
    $twig = $this->getTemplateTwig();
    if (!isset($this->findTwigs()[$twig])) {
      throw new TemplateException('Unknown template: ' . $twig,
        TemplateException::UNKNOWN_TWIG);
    }
    
    return $twig;
  }
  
  /**
   * getTemplateTwig
   *
   * Returns the name of the twig file for this template.
   *
   * @return string
   */
  abstract protected function getTemplateTwig(): string;
  
  /**
   * findTwigs
   *
   * Returns an array of twig filenames located within this theme.
   *
   * @return array
   * @throws TransformerException
   * @throws HandlerException
   */
  private function findTwigs(): array
  {
    // in a production environment, we don't want to do a filesystem search
    // unless we have to.  so, if we're not debugging and it's not a new
    // version of this theme, then we assume that the list of twigs is the
    // same as the last time we searched for them.
    
    if (!self::isDebug() && !$this->isNewThemeVersion()) {
      return $this->getOption('twigs', []);
    }
    
    $directory = new RecursiveDirectoryIterator(     // get all files
      get_stylesheet_directory() . '/assets/twigs/', // in or under this folder
      FilesystemIterator::SKIP_DOTS                  // skipping . and ..
    );
    
    $files = new RegexIterator(                      // limit results
      new RecursiveIteratorIterator($directory),     // within this iterator
      '/.twig$/',                                    // using this regex
      RegexIterator::MATCH,                          // keeping matches
      RegexIterator::USE_KEY                         // based on keys
    );
    
    // now, we convert our iterator to an array and get it's keys.  these are
    // the paths to each twig file (the values of SplFileInfo objects; we don't
    // need those).  and, if we're on Windows, we do a quick normalization of
    // the directory separator.
    
    $twigs = array_keys(iterator_to_array($files));
    
    if (substr(PHP_OS, 0, 3) === 'WIN') {
      array_walk($twigs, fn(&$twig) => $twig = str_replace('\\', '/', $twig));
    }
    
    // our map here splits the full path names based on the folder in which our
    // twigs are located.  then, everything after that folder with the Timber
    // @ namespace prefix should match the twig files that our templates want
    // to use.  finally, we flip the array to do O(1) lookups instead of O(N)
    // searches.
    
    $twigs = array_flip(
      array_map(
        fn($twig) => '@' . explode('assets/twigs/', $twig)[1],
        $twigs
      )
    );
    
    $this->updateOption('twigs', $twigs);
    return $twigs;
  }
  
  /**
   * isNewThemeVersion
   *
   * Returns true if the theme is at a new version number compared to the one
   * we remember from last time.
   *
   * @return string
   * @throws HandlerException
   * @throws TransformerException
   */
  private function isNewThemeVersion(): string
  {
    $knownVersion = $this->getOption('version');
    $currentVersion = wp_get_theme()->get('Version');
    
    if ($knownVersion !== $currentVersion) {
      $this->updateOption('version', $currentVersion);
      return true;
    }
    
    return false;
  }
  
  /**
   * getContext
   *
   * Returns an array of data used to compile this page's template file.
   *
   * @return array
   * @throws HandlerException
   * @throws RepositoryException
   * @throws TemplateException
   * @throws TransformerException
   */
  private function getContext(): array
  {
    $siteContext = $this->getSiteContext();
    $templateContext = $this->getTemplateContext($siteContext);
    return array_merge($siteContext, $templateContext);
  }
  
  /**
   * getSiteContext
   *
   * Returns information that is global, i.e. it's the same throughout the
   * site.
   *
   * @return array
   * @throws HandlerException
   * @throws RepositoryException
   * @throws TemplateException
   * @throws TransformerException
   */
  private function getSiteContext(): array
  {
    return [
      'year'  => date('Y'),
      'twig'  => basename($this->getTwig(), '.twig'),
      'site'  => [
        'url'    => home_url(),
        'title'  => 'Dashifen.com',
        'images' => get_stylesheet_directory_uri() . '/assets/images/',
        'logo'   => [
          'alt' => 'a witch\'s hat with a purple band and a gold buckle',
          'src' => 'witch-hat.png',
        ],
      ],
      'menus' => [
        'main'   => $this->getMainMenu(),
        'footer' => $this->getFooterMenu(),
      ],
    ];
  }
  
  /**
   * getMainMenu
   *
   * Returns the MenuItems for the main menu.
   *
   * @return MenuItem[]
   * @throws RepositoryException
   */
  private function getMainMenu(): array
  {
    return $this->getMenu('main');
  }
  
  /**
   * getMenu
   *
   * Returns an array of MenuItems describing the contents of the menu at the
   * specified location.
   *
   * @param string $menuLocation
   *
   * @return MenuItem[]
   * @throws RepositoryException
   */
  private function getMenu(string $menuLocation): array
  {
    return has_nav_menu($menuLocation)
      ? array_map(fn($item) => new MenuItem($item), (new TimberMenu($menuLocation))->get_items())
      : [];
  }
  
  /**
   * getFooterMenu
   *
   * Returns the MenuItems for the utility menu in the footer.
   *
   * @return MenuItem[]
   * @throws RepositoryException
   */
  private function getFooterMenu(): array
  {
    return $this->getMenu('footer');
  }
  
  /**
   * getTemplateContext
   *
   * Returns an array of information necessary for the compilation of this
   * specific template.
   *
   * @param array $siteContext
   *
   * @return array
   */
  abstract protected function getTemplateContext(array $siteContext): array;
  
  /**
   * compile
   *
   * Compiles either a previously set template file and context or can use
   * the optional parameters here to specify the file and context at the time
   * of the call and returns it to the calling scope.     *
   *
   * @param bool        $debug
   * @param string|null $file
   * @param array|null  $context
   *
   * @return string
   * @throws TemplateException
   */
  public function compile(bool $debug = false, ?string $file = null, ?array $context = null): string
  {
    if (($file ??= $this->file) === null) {
      throw new TemplateException('Cannot compile without a twig file.',
        TemplateException::UNKNOWN_TWIG);
    }
    
    if (($context ??= $this->context) === null) {
      throw new TemplateException('Cannot compile without a twig context.',
        TemplateException::UNKNOWN_CONTEXT);
    }
    
    $compilation = Timber::fetch($file, $context);
    
    if ($debug || self::isDebug()) {
      $compilation .= '<!--' . PHP_EOL . print_r($context, true) . PHP_EOL . '-->';
    }
    
    return $compilation;
  }
  
  /**
   * getOptionNamePrefix
   *
   * Returns the prefix that that is used to differentiate the options for
   * this handler's sphere of influence from others.
   *
   * @return string
   */
  public function getOptionNamePrefix(): string
  {
    return Theme::SLUG . '-';
  }
  
  /**
   * getOptionNames
   *
   * Returns an array of valid option names for use within the isOptionValid
   * method.
   *
   * @return array
   */
  protected function getOptionNames(): array
  {
    return ['twigs', 'version'];
  }
}

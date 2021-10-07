<?php

namespace Dashifen\Dashifen2022;

use Dashifen\WPHandler\Handlers\HandlerException;
use Dashifen\WPHandler\Handlers\Themes\AbstractThemeHandler;

class Theme extends AbstractThemeHandler
{
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
      $this->addAction('wp_enqueue_scripts', 'addAssets');
    }
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
    $fonts = $this->enqueue('//fonts.googleapis.com/css2?family=El+Messiri&family=Roboto&display=swap');
    $css = $this->enqueue('assets/dashifen-2022.css', [$fonts]);

    $dir = trailingslashit($this->getStylesheetDir());
    if (file_exists($dir . 'assets/dashifen-2022-components.css')) {
      $this->enqueue('assets/dashifen-2022-components.css', [$css]);
    }
  }
}

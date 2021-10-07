<?php
/**
 * @noinspection PhpStatementHasEmptyBodyInspection
 */

namespace Dashifen;

use Dashifen\Dashifen2022\Theme;
use Dashifen\WPHandler\Handlers\HandlerException;

if (file_exists($autoloader = ABSPATH . '/deps/vendor/autoload.php'));
else $autoloader = 'vendor/autoload.php';
require_once $autoloader;

(function () {
  
  // by instantiating variables herein, we prevent them from being added to the
  // WordPress global scope.  this should make it so that any public methods of
  // our objects remain inaccessible except within the context of this theme.
  
  try {
    $theme = new Theme();
    $theme->initialize();  
  } catch (HandlerException $e) {
    Theme::catcher($e);
  }
})();

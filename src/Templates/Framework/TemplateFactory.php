<?php

namespace Dashifen\Dashifen2022\Templates\Framework;

use Dashifen\Dashifen2022\Templates\Homepage;

class TemplateFactory
{
  /**
   * produceTemplate
   *
   * Given the name of a template object, constructs and returns it.
   *
   * @param string $template
   *
   * @return AbstractTemplate
   * @throws TemplateException
   */
  public static function produceTemplate(string $template): AbstractTemplate
  {
    switch($template) {
      case 'Homepage':
        return new Homepage();
    }
    
    throw new TemplateException('Unknown template: ' . $template,
      TemplateException::UNKNOWN_TEMPLATE);
  }
}

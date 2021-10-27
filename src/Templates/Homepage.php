<?php

namespace Dashifen\Dashifen2022\Templates;

use Dashifen\Dashifen2022\Templates\Framework\AbstractTemplate;

class Homepage extends AbstractTemplate
{
  /**
   * getTemplateTwig
   *
   * Returns the name of the twig file for this template.
   *
   * @return string
   */
  protected function getTemplateTwig(): string
  {
    return '@templates/index.twig';
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
  protected function getTemplateContext(array $siteContext): array
  {
    return [
      'page' => [
        'title' => 'Home',
      ],
    ];
  }
}

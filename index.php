<?php

namespace Dashifen;

use Dashifen\Dashifen2022\Theme;
use Dashifen\Dashifen2022\Router;
use Dashifen\Dashifen2022\Templates\Framework\TemplateFactory;
use Dashifen\Dashifen2022\Templates\Framework\TemplateException;

try {
  $templateName = Router::getTemplateObjectName();
  $templateObject = TemplateFactory::produceTemplate($templateName);
  $templateObject->render();
} catch (TemplateException $e) {
  Theme::catcher($e);
}

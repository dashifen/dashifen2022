<?php

namespace Dashifen\Dashifen2022\Templates\Framework;

use Dashifen\WPTemplates\TemplateException as BaselineTemplateException;

class TemplateException extends BaselineTemplateException
{
  // the baseline exception has some constants defined in its scope, but it
  // won't have 97 of them.  therefore, in honor of the band and to avoid
  // re-using the baseline constant values, we start there.
  
  public const UNKNOWN_TWIG = 97;
  public const UNKNOWN_CONTEXT = 98;
  public const UNKNOWN_TEMPLATE= 99;
}

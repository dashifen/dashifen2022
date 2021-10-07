<!doctype html>
<html class="no-js" <?php language_attributes() ?>>
<head>
  <title><?php apply_filters('dashifen2022-title', 'Dashifen.com') ?></title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<div id="vue-root">
  <a href="#content" class="screen-reader-text">Skip to the Content</a>
  <header id="banner" role="banner"></header>
  <main id="content" class="main"></main>
  <footer class="footer"></footer>
</div>
<?php wp_footer() ?>
</body>
</html>

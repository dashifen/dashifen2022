<!doctype html>
<html class="no-js" <?php language_attributes() ?>>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= apply_filters('dashifen2022-title', 'Dashifen.com') ?></title>
  <link rel="icon" href="<?= get_stylesheet_directory_uri() ?>/assets/images/witch-hat.png">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<a href="#content" class="screen-reader-text">Skip to the Content</a>
<header id="banner" role="banner">
  <div id="purple-band">
    <h1 id="page-title">David Dashifen Kees</h1>
    <div id="logo">
      <img alt="a witch's hat with a purple band and a gold buckle"
        src="<?= get_stylesheet_directory_uri() ?>/assets/images/witch-hat.png">
    </div>
    <?php wp_nav_menu([
      'menu' => 'main-menu',
      'container' => 'nav',
      'container_id' => 'main-menu',
      'container_aria_label' => 'Main Menu'
    ]) ?>
  </div>
  <div id="black-band">
    <p id="entry-title">Welcome to my corner of the Internet.</p>
  </div>
</header>

<main id="content" class="main"></main>
<footer class="footer"></footer>

<?php wp_footer() ?>
</body>
</html>

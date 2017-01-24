<?php

define('PILL_INIT', true);
require '../config.php';

define('CACHE_FILE', 'cache/linux-version');

function fetch_version() {
  $result = json_decode(file_get_contents('https://www.archlinux.org/packages/core/x86_64/linux/json/'), true);
  if (!$result) return false;
  if (!array_key_exists('pkgver', $result)) return false;
  return $result['pkgver'];
}

if (file_exists(CACHE_FILE) && time() - filemtime(CACHE_FILE) < 300) {
  $version = file_get_contents(CACHE_FILE);
} else {
  $version = fetch_version();
  file_put_contents(CACHE_FILE, $version);
}

if (!$version) {
  http_response_code(500);
  echo 'Unable to get version.';
  die();
}

if (strpos($version, '4.9') === 0) {
  $got_49 = true;
} else {
  $got_49 = false;
}

if (array_key_exists('format', $_GET) && $_GET['format'] == 'json') {
  header('Content-Type: application/json');
  echo json_encode([
    'got_49' => $got_49
  ]);
  die();
}

$showed_str = $got_49 ? '上了。' : '没有。';

?><!DOCTYPE html>
<html>
  <head prefix="og: http://ogp.me/ns#">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arch 今天上 4.9 了吗？</title>
    <meta name="description" content="<?= $showed_str ?>">
    <meta property="og:title" content="Arch 今天上 4.9 了吗？">
    <meta property="og:site_name" content="药丸！">
    <meta property="og:description" content="<?= $showed_str ?>">
    <meta property="og:type" content="website">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:site" content="@hkz85825915">
    <style>
      * {
        box-sizing: border-box;
      }
      html {
        font-family: sans-serif;
      }
      body {
        margin: 0;
        padding: 0;
      }
      .container {
        height: 100vh;
        width: 100%;
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
      }
      .wrapper {
        width: 100%;
      }
      .title {
        font-size: 1rem;
        margin: 1rem 0;
        text-align: center;
        font-weight: normal;
      }
      .answer {
        font-size: 4rem;
        text-align: center;
        margin: 2rem 0;
      }
      .offset {
        position: relative;
        left: 0.5em;
      }
      .footer {
        position: fixed;
        right: 0.5rem;
        bottom: 0.5rem;
        font-size: 0.8rem;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <h1 class="title"><span class="offset">Arch 今天上 4.9 了吗？</span></h1>
        <p class="answer"><span class="offset"><?= $showed_str ?></span></p>
      </div>
    </div>
    <footer class="footer">
      <a href="https://twitter.com/intent/tweet?text=<?= urlencode($got_49 ? "Arch 终于上 4.9 了！" : "Arch 今天还是没上 4.9。") ?>">Tweet</a> | <a href="https://www.archlinux.org/packages/core/x86_64/linux/">详情</a> | <a href="<?= SERVER_ROOT ?>/has-arch-got-4-9-today/?format=json">API</a>
    </footer>
  </body>
</html>

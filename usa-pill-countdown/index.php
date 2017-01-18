<?php

define('PILL_INIT', true);
require '../config.php';

$fc = 'WF0tMto';

$end_time = 1484931600; // 2017-01-20 09:00:00 -0800

$countdown = $end_time - time();

if ($countdown > 0) {
  $days = floor($countdown / 86400);
  $hours = floor(($countdown % 86400) / 3600);
  $minutes = floor(($countdown % 3600) / 60);
  $seconds = ($countdown % 60);
} else {
  $days = 0;
  $hours = 0;
  $minutes = 0;
  $seconds = 1;
}

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>美国药丸倒计时</title>
    <link rel="stylesheet" href="/usa-pill-countdown/bower_components/bootstrap/dist/css/bootstrap.min.css?v=<?= $fc ?>">
    <link rel="stylesheet" href="/usa-pill-countdown/bower_components/bootstrap/dist/css/bootstrap-theme.min.css?v=<?= $fc ?>">
    <link rel="stylesheet" href="/usa-pill-countdown/style.css?v=<?= $fc ?>">
    <?php if ($countdown > 0) { ?>
    <noscript>
      <meta http-equiv="Refresh" content="5">
    </noscript>
    <?php } ?>
  </head>
  <body class="<?= $countdown > 0 ? '' : 'countdown-end' ?>">
    <div class="bg-container">
      <img class="bg-gray" src="/usa-pill-countdown/bg-gray.svg?v=<?= $fc ?>" alt="">
      <img class="bg-color" src="/usa-pill-countdown/bg.svg?v=<?= $fc ?>" alt="">
    </div>
    <div class="content-container">
      <div class="content">
        <div class="page-header">
          <h1>美国药丸倒计时</h1>
        </div>
        <div class="desc">
          距离 2017 年 1 月 20 日 GMT-8 上午 9:00 还有：
        </div>
        <div id="countdown">
          <?= $days.' 天 '.$hours.' 时 '.$minutes.' 分 '.$seconds.' 秒' ?>
        </div>
        <div class="buttons">
          <a class="btn btn-primary" href="http://www.mirror.co.uk/news/world-news/when-donald-trump-president-inauguration-9223960" target="_blank">了解更多</a>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var endTime = <?= $end_time ?>

        refreshCountdown()
        setInterval(refreshCountdown, 1000)

        function refreshCountdown() {
          var current = Math.floor(Date.now() / 1000)
          var countdown = endTime - current

          if (countdown > 0) {
            var days = Math.floor(countdown / 86400)
            var hours = Math.floor((countdown % 86400) / 3600)
            var minutes = Math.floor((countdown % 3600) / 60)
            var seconds = (countdown % 60)

            var text = days+' 天 '+hours+' 时 '+minutes+' 分 '+seconds+' 秒'
            document.getElementById('countdown').innerText = text
          } else {
            var el = document.getElementsByTagName('body')[0]
            el.className = 'countdown-end'
          }
        }
      })
    </script>
  </body>
</html>

<?php

/* check for age */
  $html5->rtalabel();
  if(! $spiderAgent) {
    if(! isset($_SESSION['agev'])) {
      $splash = new anetAgeverify($dom, $pdo);
      $splash->splashscreen();
      $scriptManager->addStyle('splashscreen.css', 'anet.plugin.ageverify');
      $scriptManager->addScript('splashscreen.js', 'anet.plugin.ageverify');
    }
  }





















?>
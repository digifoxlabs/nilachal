<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

  <head>
    <title><?= $pageTitle; ?></title>

    <?php
        // Access the app config to get the global asset version
        $config = config('App');
        $assetVersion = $config->assetVersion;
    ?>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <!-- <link rel="icon" href="images/icon_ico.ico" type="image/x-icon"> -->
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700%7CPoppins:400%7CTeko:300,400">

  
    <?= link_tag(base_url('public/assets/frontend/css/bootstrap.css') . '?v=' . $assetVersion) ?>
    <?= link_tag(base_url('public/assets/frontend/css/fonts.css') . '?v=' . $assetVersion) ?>
    <?= link_tag(base_url('public/assets/frontend/css/style.css') . '?v=' . $assetVersion) ?>
    <?= link_tag(base_url('public/assets/admin/css/style.css') . '?v=' . $assetVersion) ?>


    <!-- <link rel="stylesheet" href="admin/css/style.css"> -->
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}
   

   </style>
  </head>
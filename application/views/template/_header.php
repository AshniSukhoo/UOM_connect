<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?=(isset($title) && !empty($title))?$title:''?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php include('_css.php'); ?>
    <?php if(isset($hasAd) && $hasAd == true): ?>
        <script type="text/javascript" charset="utf-8">
            /*(function(G,o,O,g,L,e){G[g]=G[g]||function(){(G[g]['q']=G[g]['q']||[]).push(
                    arguments)},G[g]['t']=1*new Date;L=o.createElement(O),e=o.getElementsByTagName(
                O)[0];L.async=1;L.src='//www.google.com/adsense/search/async-ads.js';
                e.parentNode.insertBefore(L,e)})(window,document,'script','_googCsa');*/
        </script>
    <?php endif; ?>
</head>
<body>
<div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">

            <?php include('_sidebar-navigation.php'); ?>

            <!-- main right col -->
            <div class="column col-sm-11 col-xs-11" id="main">

                <?php include('_top-navigation.php') ?>

                <div class="padding">
                    <div class="full col-sm-9">
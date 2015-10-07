<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?=(isset($title) && !empty($title))?$title:''?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php include('_css.php'); ?>
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
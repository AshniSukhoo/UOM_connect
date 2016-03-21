<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?=(isset($title) && $title != null) ? $title : 'UOM-Connect'?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php $this->load->view('template/_css') ?>
</head>
<body class="login-with-bg">

<div class="wrapper">

    <div class="row">
        <!-- main col -->
        <div class="column col-sm-12 col-xs-12" id="main-login">

            <?php $this->load->view('template/_top-navigation') ?>

            <div class="padding">

                <div class="container full">

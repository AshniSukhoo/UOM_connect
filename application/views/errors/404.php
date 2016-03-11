<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Uom-Connect</title>
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

                    <div class="row">

                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default" style="margin-top: 50px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-warning"></i> Sorry, this content isn't available right now
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                            <p>
                                                The link you followed may have expired, or the page may only be visible to an audience you're not in.
                                            </p>
                                            <a class="active" href="<?=$this->agent->referrer()?>">Go back to previous page</a> .
                                            <a class="active" href="<?=base_url()?>">Homepage</a> .
                                            <a class="active" href="<?=base_url('contact-us')?>">Contact us</a>
                                        </div><!--/.col-md-8 col-md-offset-2-->
                                    </div><!--/.row-->
                                </div><!--/.panel-body-->
                            </div><!--/.panel-->
                        </div><!--/.col-md-8 col-md-offset-2-->

                    </div><!--/.row-->

                </div><!--/.container-->

            </div><!--/.padding-->

        </div>
    </div><!--/.row-->

</div><!--/.wrapper-->

<?php $this->load->view('template/_js') ?>

</body>
</html>

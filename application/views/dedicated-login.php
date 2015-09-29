<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Login into UOM-Connect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php include('template/_css.php'); ?>
</head>
<body class="login-with-bg">

<div class="wrapper">

    <div class="row">
        <!-- main col -->
        <div class="column col-sm-12 col-xs-12" id="main-login">

            <?php include('template/_top-navigation.php') ?>

            <div class="padding">

                <div class="container full">

                    <div class="row">

                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default" style="margin-top: 50px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        UOM-Connect Login
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                            <?php include('partials/_vertical-login-form.php') ?>
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

<?php include('template/_js.php'); ?>
<script type="text/javascript" src="/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    });
</script>

</body>
</html>
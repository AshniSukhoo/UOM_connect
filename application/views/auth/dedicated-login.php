<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Login into UOM-Connect</title>
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
                                        UOM-Connect Login
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                            <?php $this->load->view('partials/_vertical-login-form') ?>
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
<script type="text/javascript" src="/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        /*
         Remove error from form-group
         */
        function removeError(formGroup) {
            if(formGroup.find('.server-error').length > 0) {
                formGroup.find('.server-error').remove();
                formGroup.removeClass('has-error');
            }
        }

        $('input').on('keyup', function(){
            var formGroup = $(this).parents('.form-group').first();
            removeError(formGroup);
        });

        $('#login-form').validate({
            ignore:[],
            rules: {
                login_email: {
                    required: true,
                    email: true,
                },
                login_password: {
                    required: true,
                    minlength: 5,
                },
            },
            messages: {
                login_email:{
                    required: "The Email field is required.",
                    email: "The Email field must be a valid email address.",
                },
                login_password: {
                    required: "The Password field is required.",
                    minlength: "The Password field must be at least 5 characters.",
                },
            },
            highlight: function (label) {
                $(label).closest('.form-group ').addClass('has-error');
            },
            success: function (label) {
                $(label).closest('.form-group ').removeClass('has-error');
            },
            errorElement: 'small',
            errorPlacement: function(error, element) {
                element.parents('.form-group').first().append(error);
                error.addClass('help-block');
            },
        })

    });
</script>

</body>
</html>

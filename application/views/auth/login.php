<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Welcome to UOM-Connect - First student portal and social network</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php $this->load->view('template/_css') ?>
</head>
<body class="login-with-bg">

<div class="wrapper">

    <div class="row">
        <!-- main col -->
        <div class="column col-sm-12 col-xs-12" id="main-login">

            <?php $this->load->view('template/_top-navigation.php') ?>

            <div class="padding">

                <div class="container full">

                    <div class="row">

                        <div class="col-sm-5">

                        </div><!--/.col-sm-5-->

                        <div class="col-sm-7">

                            <div class="panel" style="margin-top: 50px;">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h2 class="my-panel-title">Create your profile</h2>
                                            <p>Students and Lecturers of UOM, welcome to your portal.</p>
                                        </div><!--/.col-sm-12-->
                                    </div><!--/.row-->
                                    <?php $this->load->view('partials/_sign-up-form') ?>
                                </div>
                            </div><!--/.panel-->

                            <small style="color: #ffffff">

                                By clicking Sign Up, you agree to our <a style="color: #428bca;" href="<?=base_url()?>terms-and-conditions">Terms of use and Data Policy</a>.
                            </small>

                        </div><!--/.col-sm-7-->

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
        $('select').on('change', function(){
            var formGroup = $(this).parents('.form-group').first();
            removeError(formGroup);
        });
        $('input[type="radio"]').on('change', function(){
            var formGroup = $(this).parents('.form-group').first();
            removeError(formGroup);
        });

        $('#signup-form').validate({
            ignore:[],
            rules: {
                firstName: {
                    required: true,
                },
                lastName: {
                    required: true,
                },
				email: {
					required:true,
				},
				password: {
					required: true,
                    minlength: 5,
				},
				confirmPassword: {
					required: true,
                    equalTo: "#password",
                    minlength: 5,
				},
                userType: {
                    required: true,
                },
                DOBDay: {
                    required: true,
                },
                DOBMonth: {
                    required: true,
                },
                DOBYear: {
                    required: true,
                },
                gender: {
                    required: true,
                },
				uomId:  {
					required: true,
				},
            },
            messages: {
                firstName: {
                    required: "The First name field is required."
                },
                lastName: {
                    required: "The Last name field is required.",
                },
				email:	{
					required: "Email address field is required.",
				},
				password: {
					required: "Password field is required.",
                    minlength: "Password must contain at least 5 characters",
				},
				confirmPassword: {
					required: "Password confirmation field is required.",
                    equalTo: "The password confirmation does not match the password.",
                    minlength: "Password must contain at least 5 characters",
				},
                userType: {
                    required: "The User type field is required.",
                },
                DOBDay: {
                    required: "The Birthday\'s day field is required."
                },
                DOBMonth: {
                    required: "The Birthday\'s month field is required."
                },
                DOBYear: {
                    required: "The Birthday\'s year field is required.",
                },
                gender: {
                    required: "The Gender field is required.",
                },
				uomId: {
					required: "UOM ID field is required.",
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
        });

    });
</script>

</body>
</html>

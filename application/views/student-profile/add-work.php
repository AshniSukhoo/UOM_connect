<?php $hasAd = true; ?>
<?php
$css = [
    '/css/bootstrap-tagsinput.css',
	'/css/bootstrap-datetimepicker.css',
];
?>
<?php include(APPPATH.'views/template/_header.php'); ?>
    <style type="text/css">
        .bootstrap-tagsinput {
            width: 100% !important;
            border-bottom-left-radius: 0px;
            border-top-left-radius: 0px;
        }
        .bootstrap-tagsinput input {
            width: 100% !important;
        }
    </style>

    <!-- content -->
    <div class="container">
        <?php include(APPPATH.'views/student-profile/partials/_profile-summary.php'); ?>

        <div class="row">
            <div class="col-md-4">
                <?php include(APPPATH.'views/student-profile/partials/_student-about-summary.php'); ?>
            </div><!--/.col-md-4-->

            <div class="col-md-8">
                <?php include(APPPATH.'views/student-profile/partials/_profile-navigation.php'); ?>

                <?php if(isset($handle) && $handle == 'add'): ?>
	                <?php include(APPPATH.'views/student-profile/partials/about-forms/_add-work.php'); ?>
                <?php endif; ?>

                <?php if(isset($handle) && $handle == 'edit'): ?>
	                <?php include(APPPATH.'views/student-profile/partials/about-forms/_edit-work.php'); ?>
                <?php endif; ?>


                <?php include(APPPATH.'views/student-profile/partials/about-sections/_basic-info-section.php'); ?>

                <?php include(APPPATH.'views/student-profile/partials/about-sections/_details-about-user-section.php'); ?>
            </div><!--/.col-md-8-->

        </div><!--/.row-->

    </div><!--/.container-->

<?php $js_plugins = [
    '/js/plugins/autogrow/jquery.autogrowtextarea.min.js',
    '/js/plugins/tags-input/bootstrap-tagsinput.js',
	'/js/plugins/moment/min/moment-with-locales.min.js',
	'/js/plugins/datetimepicker/bootstrap-datetimepicker.js'
]; ?>
<?php include(APPPATH.'views/template/_footer.php'); ?>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".post-status-area").autoGrow();

            $('input[name="emails"]').tagsinput();

            $('input[name="job_title"]').focus();

	        $('.datepicker').datetimepicker({
		        viewMode: 'years',
		        format: 'DD/MM/YYYY',
		        maxDate: moment()
	        });
        });
    </script>

<?php include(APPPATH.'views/template/_closing-body.php'); ?>
<?php $hasAd = true; ?>
<?php
	$css = [
		'/css/bootstrap-tagsinput.css',
	];
?>
<?php $this->load->view('template/_header') ?>
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
        <?php $this->load->view('student-profile/partials/_profile-summary') ?>

        <div class="row">
            <div class="col-md-4">
                <?php $this->load->view('student-profile/partials/_student-about-summary') ?>
            </div><!--/.col-md-4-->

            <div class="col-md-8">
                <?php $this->load->view('student-profile/partials/_profile-navigation') ?>

                <?php $this->load->view('student-profile/partials/about-forms/_basic-info-form') ?>

                <?php $this->load->view('student-profile/partials/about-sections/_work-and-education-section') ?>

                <?php $this->load->view('student-profile/partials/about-sections/_details-about-user-section') ?>
            </div><!--/.col-md-8-->

        </div><!--/.row-->

    </div><!--/.container-->

<?php $js_plugins = [
    '/js/plugins/autogrow/jquery.autogrowtextarea.min.js',
	'/js/plugins/tags-input/bootstrap-tagsinput.js',
]; ?>
<?php $this->load->view('template/_footer') ?>

	<?php $this->load->view('student-profile/partials/_js-common') ?>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".post-status-area").autoGrow();

	        $('input[name="emails"]').tagsinput();

	        $('input[name="country"]').focus();
        });
    </script>

<?php $this->load->view('template/_closing-body') ?>

<?php $hasAd = true; ?>
<?php
	$css = [
		'/css/bootstrap-tagsinput.css',
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

				<?php include(APPPATH.'views/student-profile/partials/about-forms/_add-edit-details.php'); ?>

				<?php include(APPPATH.'views/student-profile/partials/about-sections/_basic-info-section.php'); ?>

				<?php include(APPPATH.'views/student-profile/partials/about-sections/_work-and-education-section.php'); ?>

			</div><!--/.col-md-8-->

		</div><!--/.row-->

	</div><!--/.container-->

<?php $js_plugins = [
	'/js/plugins/autogrow/jquery.autogrowtextarea.min.js',
	'/js/plugins/tags-input/bootstrap-tagsinput.js',
]; ?>
<?php include(APPPATH.'views/template/_footer.php'); ?>

	<?php include(APPPATH.'views/student-profile/partials/_js-common.php'); ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.tags-input').tagsinput();

			$('input[name="hobbies"]').focus();

			$('textarea[name="about"]').autoGrow();
		});
	</script>

<?php include(APPPATH.'views/template/_closing-body.php'); ?>
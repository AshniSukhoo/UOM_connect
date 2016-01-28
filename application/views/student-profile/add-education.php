<?php $hasAd = true; ?>
<?php include(APPPATH.'views/template/_header.php'); ?>
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
					<?php include(APPPATH.'views/student-profile/partials/about-forms/_add-education.php'); ?>
				<?php endif; ?>

				<?php if(isset($handle) && $handle == 'edit'): ?>
					<?php include(APPPATH.'views/student-profile/partials/about-forms/_edit-education.php'); ?>
				<?php endif; ?>

				<?php include(APPPATH.'views/student-profile/partials/about-sections/_basic-info-section.php'); ?>

				<?php include(APPPATH.'views/student-profile/partials/about-sections/_details-about-user-section.php'); ?>
			</div><!--/.col-md-8-->

		</div><!--/.row-->

	</div><!--/.container-->

<?php $js_plugins = [
	'/js/plugins/autogrow/jquery.autogrowtextarea.min.js',
]; ?>
<?php include(APPPATH.'views/template/_footer.php'); ?>

	<?php include(APPPATH.'views/student-profile/partials/_js-common.php'); ?>

	<script type="text/javascript">
		$(document).ready(function(){
			$(".post-status-area").autoGrow();

			$('input[name="emails"]').tagsinput();

			$('input[name="institution_name"]').focus();
		});
	</script>

<?php include(APPPATH.'views/template/_closing-body.php'); ?>
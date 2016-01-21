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

                <?php include(APPPATH.'views/partials/_notifications-alert.php'); ?>

                <?php include(APPPATH.'views/student-profile/partials/about-sections/_basic-info-section.php'); ?>

                <?php include(APPPATH.'views/student-profile/partials/about-sections/_work-and-education-section.php'); ?>

                <?php include(APPPATH.'views/student-profile/partials/about-sections/_details-about-user-section.php'); ?>
            </div><!--/.col-md-8-->

        </div><!--/.row-->

    </div><!--/.container-->

<?php $js_plugins = [
    '/js/plugins/autogrow/jquery.autogrowtextarea.min.js',
]; ?>
<?php include(APPPATH.'views/template/_footer.php'); ?>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".post-status-area").autoGrow();

	        $('.link-button').on('click', function(e) {
		        e.stopPropagation();
		        e.preventDefault();
		        window.location.href = $(this).attr('data-target');
	        })
        });
    </script>

<?php include(APPPATH.'views/template/_closing-body.php'); ?>
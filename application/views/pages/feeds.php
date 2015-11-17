<?php include(APPPATH.'views/template/_header.php'); ?>

<!-- content -->
<div class="container">
	<div class="col-md-6">
		<?php include(APPPATH.'views/pages/partials/post-status.php'); ?>

		<?php for($i = 0; $i < 10; $i++): ?>
             <?php include(APPPATH.'views/partials/_post-template.php'); ?>
        <?php endfor; ?>

	</div><!--/.col-md-6-->

	<div class="col-md-2">
		col 2 here: advertisement/reminders area if any//check for unclosed tag to enable login
	</div><!--/.col-md-2-->
	
	<div class="col-md-1">
	col md 1 space
	</div><!--/.col-md-1-->
	
    <div class="col-md-3">
		<?php for($i = 0; $i < 100; $i++): ?>
			<?php include(APPPATH.'views/pages/partials/chat-list-template.php'); ?>
		 <?php endfor; ?>
	</div><!--/.col-md-3-->
</div><!--/.container-->


<?php $js_plugins = [
    '/js/plugins/autogrow/jquery.autogrowtextarea.min.js',
]; ?>
<?php include(APPPATH.'views/template/_footer.php'); ?>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".post-status-area").autoGrow();

        });
    </script>

<?php include(APPPATH.'views/template/_footer.php'); ?>

<?php include(APPPATH.'views/template/_closing-body.php'); ?>


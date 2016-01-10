<?php $hasAd = true; ?>
<?php include(APPPATH.'views/template/_header.php'); ?>

<!-- content -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php include(APPPATH.'views/student-profile/partials/_post-status-form.php'); ?>

            <?php for($i = 0; $i < 10; $i++): ?>
                <?php include(APPPATH.'views/partials/_post-template.php'); ?>
            <?php endfor; ?>
        </div><!--/.col-md-8-->

        <div class="col-md-3">
            <?php include(APPPATH.'views/pages/partials/_post-advertisement-template.php'); ?>
        </div><!--/.col-md-4-->
    </div><!--/.row-->
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

<?php include(APPPATH.'views/template/_closing-body.php'); ?>


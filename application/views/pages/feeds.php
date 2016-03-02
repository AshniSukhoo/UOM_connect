<?php $this->load->view('template/_header.php', [
    'hasAd' => true
]) ?>

<!-- content -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php $this->load->view('student-profile/partials/_post-status-form') ?>

            <?php for($i = 0; $i < 10; $i++): ?>
                <?php $this->load->view('partials/_post-template') ?>
            <?php endfor; ?>
        </div><!--/.col-md-8-->

        <div class="col-md-3">
            <?php $this->load->view('pages/partials/_post-advertisement-template') ?>
        </div><!--/.col-md-4-->
    </div><!--/.row-->
</div><!--/.container-->

<?php $this->load->view('template/_footer', [
    'js_plugins' => [
        '/js/plugins/autogrow/jquery.autogrowtextarea.min.js'
    ]
]) ?>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".post-status-area").autoGrow();

        });
    </script>

<?php $this->load->view('template/_closing-body') ?>


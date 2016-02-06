<?php $hasAd = true; ?>
<?php $this->load->view('template/_header') ?>

<!-- content -->
<div class="container">
    <?php $this->load->view('student-profile/partials/_profile-summary') ?>

    <div class="row">
        <div class="col-md-4">
            <?php $this->load->view('student-profile/partials/_student-about-summary') ?>
        </div><!--/.col-md-4-->

        <div class="col-md-8">
            <?php $this->load->view('student-profile/partials/_profile-navigation') ?>
            <?php if($profileOwner->is($this->auth->user())): ?>
                <?php $this->load->view('student-profile/partials/_post-status-form') ?>
            <?php endif; ?>

            <?php if(isset($posts) && $posts != null): ?>
	            <?php $this->load->view('partials/_posts-grid.php', ['posts' => $posts]) ?>
            <?php endif; ?>
        </div><!--/.col-md-8-->

    </div><!--/.row-->

</div><!--/.container-->

<?php $this->load->view('template/_footer', ['js_plugins' => [
	'/js/plugins/autogrow/jquery.autogrowtextarea.min.js',
]]); ?>

<?php $this->load->view('student-profile/partials/_js-common') ?>

	<script type="text/javascript">
        $(document).ready(function(){
            $(".post-status-area").autoGrow();

        });
    </script>

<?php $this->load->view('template/_closing-body') ?>
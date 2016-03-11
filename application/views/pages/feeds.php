<?php $this->load->view('template/_header', [
    'hasAd' => true
]) ?>

<!-- content -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php $this->load->view('student-profile/partials/_post-status-form') ?>

            <div class="posts-container">
                <?php if(isset($feeds) && $feeds != null): ?>
                    <?php $this->load->view('partials/_posts-grid', ['posts' => $feeds]) ?>
                <?php else: ?>
                    <h1 id="no-feeds-text" class="text-center">
                        <i class="fa fa-newspaper-o"></i> No feeds yet
                    </h1>
                <?php endif; ?>
            </div><!--/.posts-container-->
        </div><!--/.col-md-8-->

        <div class="col-md-3">
            <?php $this->load->view('pages/partials/_post-advertisement-template') ?>
        </div><!--/.col-md-4-->
    </div><!--/.row-->
</div><!--/.container-->

<?php $this->load->view('template/_footer', [
    'js_plugins' => [
        '/js/plugins/autogrow/autogrow.min.js',
    ]
]) ?>

<?php $this->load->view('partials/_js-timeline-actions', [
    'nextPageUrl' => (isset($nextPageUrl) && $nextPageUrl != null) ? $nextPageUrl : ''
]) ?>

<?php $this->load->view('template/_closing-body') ?>


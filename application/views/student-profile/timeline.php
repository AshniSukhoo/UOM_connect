<?php $this->load->view('template/_header', [
	'hasAd' => true
]) ?>

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

            <div class="posts-container">
	            <?php if(isset($posts) && $posts != null): ?>
		            <?php $this->load->view('partials/_posts-grid', ['posts' => $posts]) ?>
	            <?php else: ?>
                    <h1 id="no-feeds-text" class="text-center">
                        <i class="fa fa-newspaper-o"></i> No posts yet
                    </h1>
                <?php endif; ?>
            </div><!--/.posts-container-->
        </div><!--/.col-md-8-->

    </div><!--/.row-->

</div><!--/.container-->

<?php $this->load->view('template/_footer', [
    'js_plugins' => [
        '/js/plugins/autogrow/autogrow.min.js',
    ]
]); ?>

<?php $this->load->view('student-profile/partials/_js-common') ?>
<?php $this->load->view('partials/_js-timeline-actions', [
    'nextPageUrl' => (isset($nextPageUrl) && $nextPageUrl != null) ? $nextPageUrl : ''
]) ?>
<?php $this->load->view('template/_closing-body') ?>

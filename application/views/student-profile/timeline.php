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
	            <?php endif; ?>
            </div><!--/.posts-container-->
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

	        $('.posts-container').on('click', '.more-comments', function(e) {
		        e.preventDefault();
		        var loader = '<?=Html::moreCommentsLoader()?>';
		        var more_comments = $(e.target);
		        var comments_container = more_comments.parents('.panel-footer').first().find('.comments-container');
		        var prevMoreCommentsButton = more_comments.parents('.row').first();
		        $.ajax({
			        url: more_comments.attr('href'),
			        type: 'GET',
			        dataType: 'JSON',
			        beforeSend: function() {
				        more_comments.parents('.row').first().remove();
				        comments_container.prepend(loader);
			        },
			        success: function(data) {
				        comments_container.find('.more-comments-loader').remove();
				        if(data.error == false) {
					        comments_container.prepend(data.comments);
				        } else {
					        comments_container.prepend(prevMoreCommentsButton);
					        alertError(data.message);
				        }
			        }
		        });
	        });
        });
    </script>

<?php $this->load->view('template/_closing-body') ?>
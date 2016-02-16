<div class="panel panel-default">
	<div class="panel-body" style="padding-bottom: 10px">
		<div class="row">
			<div class="col-md-12">
				<img src="<?=$post->user->profile_picture?>" class="post-photo" />
				<a href="<?=$post->user->profile_uri?>" class="poster-name">
					<?=$post->user->full_name?>
				</a>
				<br class="clearfix" />
				<abbr title="<?=$post->created_at->toRfc822String()?>" class="text-muted post-time"><?=$post->created_at->diffForHumans()?></abbr>
			</div><!--/.col-md-2-->
		</div><!--/row-->
		<div class="row" style="padding-top: 15px;">
			<div class="col-md-12">
				<p class="post-text">
					<?=$post->as_html?>
				</p>
			</div><!--/.col-md-12-->
		</div><!--/.row-->
		<div class="row">
			<div class="col-md-12">
				<hr style="margin: 10px 0px;"/>
			</div><!--/.col-md-12-->
		</div><!--/.row-->
		<?php if($this->auth->check()): ?>
			<div class="row">
				<div class="col-md-12">
					<a href="javascript:;" class="text-muted <?=($this->auth->user()->liked($post))?'unlike-action active':'like-action'?>" data-post-id="<?=$post->id?>">
						<i class="fa fa-thumbs-up"></i> Like
					</a>
					<a href="javascript:;" class="comment-action text-muted">
						<i class="fa fa-comment"></i> Comment
					</a>
				</div><!--/.col-md-12-->
			</div><!--/.row-->
		<?php endif; ?>
	</div><!--/.panel-body-->
	<div class="panel-footer">
		<div class="likes-container">
			<div class="row" style="margin-bottom: 10px;">
				<div class="col-md-12">
					<?php if($post->likes()->count() > 0): ?>
						<?=Html::showPostLikes($post, $this->auth->user())?>
					<?php endif; ?>
				</div><!--/.col-md-12-->
			</div><!--/.row-->
		</div><!--/.likes-container-->

		<div class="comments-container">
			<?php if($post->hasComments()): ?>
				<?php $this->load->view('partials/_comments-grid', [
					'comments' => PostRepo::paginateComments($post),
				]) ?>
			<?php endif; ?>
		</div><!--/.comments-container-->

		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-12">
				<div class="commenter-photo-container">
					<img src="<?=$this->auth->user()->profile_picture?>" />
				</div><!--/.commenter-photo-container-->
				<form class="comment-on-post" method="post" action="<?=base_url('posts/comment')?>">
					<div class="commenter-name-container">
						<input type="hidden" name="post_id" value="<?=$post->id?>" />
						<textarea class="form-control comment-box" name="comment" placeholder="Write a comment..." style="height: 34px;"></textarea>
					</div>
				</form>
			</div><!--.col-md-12-->
		</div><!--/.row-->
	</div><!--/.panel-footer-->
</div><!--/.panel panel-default-->
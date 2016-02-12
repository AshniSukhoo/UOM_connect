<div class="row" style="margin-bottom: 10px;">
	<div class="col-md-12">
		<div class="commenter-photo-container">
			<img src="<?=$comment->user->profile_picture?>" />
		</div><!--/.commenter-photo-container-->
		<div class="commenter-name-container">
			<a href="<?=$comment->user->profile_uri?>" class="commenter-name">
				<?=$comment->user->full_name?>
			</a>
			<?=$comment->as_html?>
			<br class="clearfix"/>
			<?php if($this->auth->check()): ?>
				<a href="javascript:;" class="text-muted <?=($this->auth->user()->liked($comment))?'unlike-comment':'like-comment'?>" data-comment-id="<?=$comment->id?>">
					<?=($this->auth->user()->liked($comment))?'Unlike':'like'?>
				</a>
				-
			<?php endif; ?>
			<abbr title="<?=$comment->created_at->toRfc822String()?>" class="text-muted comment-time"><?=$comment->created_at->diffForHumans()?></abbr>
			<?php if($comment->hasLikes()): ?>
				-
				<i class="fa fa-thumbs-up"></i> <?=$comment->likes()->count()?>
			<?php endif; ?>
		</div><!--/.comment-name-container-->
	</div><!--/.col-md--12-->
</div><!--/.row-->
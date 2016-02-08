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
			<a href="javascript:;" class="text-muted">
				Like
			</a>
			-
			<abbr title="" class="text-muted comment-time"><?=$comment->created_at->diffForHumans()?></abbr>
		</div><!--/.comment-name-container-->
	</div><!--/.col-md--12-->
</div><!--/.row-->
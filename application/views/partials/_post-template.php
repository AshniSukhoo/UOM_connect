<?php $fake = Faker\Factory::create(); ?>
<div class="panel panel-default">
	<div class="panel-body" style="padding-bottom: 10px">
		<div class="row">
			<div class="col-md-12">
				<img src="/img/avatar.png" class="post-photo" />
				<a href="#" class="poster-name">
					<?=$fake->firstName?> <?=$fake->lastName?>
				</a>
				<br class="clearfix" />
				<abbr title="Sunday 1 november 2015 21:56pm" class="text-muted post-time">3 mins ago</abbr>
			</div><!--/.col-md-2-->
		</div><!--/.row-->
		<div class="row" style="padding-top: 15px;">
			<div class="col-md-12">
				<p class="post-text">
					<?=$fake->paragraph(rand(3, 10))?>
				</p>
			</div><!--/.col-md-12-->
		</div><!--/.row-->
		<div class="row">
			<div class="col-md-12">
				<hr style="margin: 10px 0px;"/>
			</div><!--/.col-md-12-->
		</div><!--/.row-->
		<div class="row">
			<div class="col-md-12">
				<a href="javascript:;" class="like-action text-muted">
					<i class="fa fa-thumbs-up"></i> Like
				</a>
				<a href="javascript:;" class="comment-action text-muted">
					<i class="fa fa-comment"></i> Comment
				</a>
			</div><!--/.col-md-12-->
		</div><!--/.row-->
    </div><!--/.panel-body-->
	<div class="panel-footer">
		<?php for($j = 0; $j < 5; $j++): ?>
			<div class="row" style="margin-bottom: 10px;">
				<div class="col-md-12">
					<div class="commenter-photo-container">
						<img src="/img/avatar.png" />
					</div><!--/.commenter-photo-container-->
					<div class="commenter-name-container">
						<a href="#" class="commenter-name">
							<?=$fake->firstName?> <?=$fake->lastName?>
						</a>
						<?=$fake->sentence(10)?>
						<br class="clearfix"/>
						<a href="javascript:;" class="text-muted">
							Like
						</a>
						-
						<abbr title="Sunday 1 november 2015 21:56pm" class="text-muted comment-time">3 mins ago</abbr>
					</div><!--/.comment-name-container-->
				</div><!--/.col-md--12-->
			</div><!--/.row-->
		<?php endfor; ?>
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-12">
				<div class="commenter-photo-container">
					<img src="/img/avatar.png" />
				</div><!--/.commenter-photo-container-->
				<div class="commenter-name-container">
					<input type="text" class="form-control" placeholder="Write a comment..." />
				</div>
			</div><!--.col-md-12-->
		</div><!--/.row-->
	</div><!--/.panel-footer-->
</div><!--/.panel panel-default-->
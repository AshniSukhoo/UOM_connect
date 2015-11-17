<?php $fake = Faker\Factory::create(); ?>
<div class="panel panel-default">
	<div class="panel-body" style="padding-bottom:10px">
		<img src="/img/avatar.png" class="post-photo" />
			<a href="#" class="poster-name">
				<?=$fake->firstName?> <?=$fake->lastName?>
			</a>
	 </div><!--/.panel-body-->
</div><!--/.panel panel-default-->
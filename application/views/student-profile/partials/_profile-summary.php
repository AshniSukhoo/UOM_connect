<div class="row">
    <div class="col-md-3">
        <a href="javascript:;" class="thumbnail" style="width: 80%;">
            <img id="img-profile-pic" style="width: 100%; height: 180px; display: block;" src="<?=$profileOwner->profile_picture?>" alt="<?=$profileOwner->full_name?>">
	        <?php if($profileOwner->is($this->auth->user())): ?>
		        <button id="changeProfilePic" type="button" class="btn btn-default btn-sm hint--info hint--top" data-hint="Change profile picture" style="position: absolute;top: 155px;">
			        <i class="fa fa-camera"></i>
		        </button>
	        <?php endif; ?>
        </a>
    </div><!--/.col-md-3-->

    <div class="col-md-9">
        <h2 style="margin-top: 40px"><?=$profileOwner->full_name?></h2>
    </div><!--/.col-md-9-->
</div><!--/.row-->

<div class="row" style="margin-bottom: 10px;">
	<div class="col-md-12">
		<?php if($profileOwner->is($this->auth->user())): ?>
			<form id="change-picture-form" method="POST" action="<?=base_url()?>save-user-profile-picture" enctype="multipart/form-data">
				<input type="file" name="profile_picture" class="hidden" />
				<button id="btn-save-profile-pic" type="submit" class="btn btn-primary btn-sm hidden">
					<i class="fa fa-check"></i> Save
				</button>
				<button id="btn-cancel-profile-pic" type="button" class="btn btn-default btn-sm hidden">
					<i class="fa fa-times"></i> Cancel
				</button>
			</form>
		<?php elseif($this->auth->check() && $this->auth->user()->isFriendsWith($profileOwner)): ?>
			<div class="profile-actions-container">
				<?=Html::unfriendButton($profileOwner->id)?>
			</div><!--/.profile-actions-container-->
		<?php elseif($this->auth->check() && $this->auth->user()->hasSentFriendRequestTo($profileOwner)): ?>
			<div class="profile-actions-container">
				<?=Html::cancelFriendRequestButton($profileOwner->id)?>
			</div><!--/.profile-actions-container-->
		<?php elseif($this->auth->check() && $this->auth->user()->hasReceivedFriendRequestFrom($profileOwner)): ?>
			<div class="profile-actions-container">
				<?=Html::acceptFriendRequestButton($profileOwner->id)?>
				<?=Html::ignoreFriendRequestButton($profileOwner->id)?>
			</div><!--/.profile-actions-container-->
		<?php elseif($this->auth->check() && $this->auth->user()->notFriendsWith($profileOwner)): ?>
			<div class="profile-actions-container">
				<?=Html::addAsFriendButton($profileOwner->id)?>
			</div><!--/.profile-actions-container-->
		<?php endif; ?>
	</div>
</div>
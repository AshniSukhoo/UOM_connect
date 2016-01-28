<div class="row">
    <div class="col-md-3">
        <a href="javascript:;" class="thumbnail" style="width: 80%;">
            <img style="width: 100%; height: 180px; display: block;" src="/img/avatar.png" alt="...">
	        <?php if($profileOwner->is($this->auth->user())): ?>
		        <button id="changeProfilePic" type="button" class="btn btn-default btn-sm hint--info hint--top" data-hint="Change profile picture" style="position: absolute;top: 155px;">
			        <i class="fa fa-camera"></i>
		        </button>
		        <form id="change-picture-form" method="POST" action="<?=base_url()?>preview/200/200" enctype="multipart/form-data">
			        <input type="file" name="profile-picture" class="hidden" />
		        </form>
	        <?php endif; ?>
        </a>
    </div><!--/.col-md-3-->

    <div class="col-md-9">
        <h2 style="margin-top: 40px"><?=$profileOwner->full_name?></h2>
    </div><!--/.col-md-9-->
</div><!--/.row-->
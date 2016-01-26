<form method="post" action="<?=base_url()?>user-actions/save-details" autocomplete="off">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-user"></i> Details about you</h4>
		</div><!--/.panel-heading-->
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group<?=($this->keeper->has('hobbies_error'))?' has-error':''?>">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-cubes"></i></span>
							<input type="text" name="hobbies" placeholder="Enter a hobby of yours and press enter to add" class="form-control tags-input" value="<?=$this->keeper->has('hobbies')?$this->keeper->get('hobbies'):(($profileOwner->detail != null && $profileOwner->detail->hobbies != null)?$profileOwner->detail->hobbies_list:'')?>" />
						</div><!--/.input-group-->
						<?=($this->keeper->has('hobbies_error'))?$this->keeper->get('hobbies_error'):''?>
					</div><!--/.form-group-->
				</div><!--/.col-md-12-->
			</div><!--/.row-->

			<div class="row">
				<div class="col-md-12">
					<div class="form-group<?=($this->keeper->has('interests_error'))?' has-error':''?>">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-flag-checkered"></i></span>
							<input type="text" name="interests" placeholder="Enter an interest of yours and press enter to add" class="form-control tags-input" value="<?=$this->keeper->has('interests')?$this->keeper->get('interests'):(($profileOwner->detail != null && $profileOwner->detail->interests != null)?$profileOwner->detail->interests_list:'')?>" />
						</div><!--/.input-group-->
						<?=($this->keeper->has('interests_error'))?$this->keeper->get('interests_error'):''?>
					</div><!--/.form-group-->
				</div><!--/.col-md-12-->
			</div><!--/.row-->

			<div class="row">
				<div class="col-md-12">
					<div class="form-group<?=($this->keeper->has('about_error'))?' has-error':''?>">
						<textarea class="form-control" name="about" placeholder="Write something about yourself"></textarea>
						<?=($this->keeper->has('about_error'))?$this->keeper->get('about_error'):''?>
					</div><!--/.form-group-->
				</div><!--/.col-md-12-->
			</div><!--/.row-->

		</div><!--/.panel-body-->
		<?php if($profileOwner->is($this->auth->user())): ?>
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary pull-right">
							<i class="fa fa-save"></i> Save
						</button>
						<a href="<?=$this->auth->user()->profile_uri.'/about'?>" class="btn btn-default">
							<i class="fa fa-times"></i> Cancel
						</a>
					</div><!--/.col-md-12-->
				</div><!--/.row-->
			</div><!--/.panel-footer-->
		<?php endif; ?>
	</div><!--/.panel-->
</form>
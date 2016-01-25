<form method="post" action="<?=base_url()?>user-actions/save-edit-work/<?=$work->id?>" autocomplete="off">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-suitcase"></i> Editing Work information</h4>
		</div><!--/.panel-heading-->
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">

					<div class="row">
						<div class="col-md-12">
							<div class="form-group<?=($this->keeper->has('job_title_error'))?' has-error':''?>">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-black-tie"></i></span>
									<input type="text" name="job_title" placeholder="Enter job title" class="form-control" value="<?=$this->keeper->has('job_title')?$this->keeper->get('job_title'):$work->job_title?>" />
								</div><!--/.input=-group--->
								<?=($this->keeper->has('job_title_error'))?$this->keeper->get('job_title_error'):''?>
							</div><!--/.form-group-->
						</div><!--/.col-md-12-->
					</div><!--/.row-->

					<div class="row">
						<div class="col-md-12">
							<div class="form-group<?=($this->keeper->has('company_name_error'))?' has-error':''?>">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-industry"></i></span>
									<input type="text" name="company_name" placeholder="Enter the name of the company you work for" class="form-control" value="<?=$this->keeper->has('company_name')?$this->keeper->get('company_name'):$work->company_name?>" />
								</div><!--/.input=-group--->
								<?=($this->keeper->has('company_name_error'))?$this->keeper->get('company_name_error'):''?>
							</div><!--/.form-group-->
						</div><!--/.col-md-12-->
					</div><!--/.row-->

					<div class="row">
						<div class="col-md-6">
							<div class="form-group<?=($this->keeper->has('date_joined_error'))?' has-error':''?>">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" name="date_joined" placeholder="Date you started new position" class="form-control datepicker" value="<?=$this->keeper->has('date_joined')?$this->keeper->get('date_joined'):$work->date_joined->format('d/m/Y')?>" />
								</div><!--/.input=-group--->
								<?=($this->keeper->has('date_joined_error'))?$this->keeper->get('date_joined_error'):''?>
							</div><!--/.form-group-->
						</div><!--/.col-md-6-->
						<div class="col-md-6">
							<div class="form-group<?=($this->keeper->has('date_left_error'))?' has-error':''?>">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" name="date_left" placeholder="Date you left position" class="form-control datepicker" value="<?=$this->keeper->has('date_left')?$this->keeper->get('date_left'):($work->date_left != null)?$work->date_left->format('d/m/Y'):''?>" />
								</div><!--/.input=-group--->
								<?=($this->keeper->has('date_left_error'))?$this->keeper->get('date_left_error'):''?>
								<small class="text-muted"><sup>#</sup>Leave blank if still working</small>
							</div><!--/.form-group-->
						</div><!--/.col-md-6-->
					</div><!--/.row-->

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
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-suitcase"></i> Work and Education</h4>
    </div><!--/.panel-heading-->
    <div class="panel-body">
        <?php if($profileOwner->hasWorkOrEduction()): ?>
	        <?php if($profileOwner->hasEducations()): ?>
		        <h4>Educational skills</h4>
		        <div class="list-group">
			        <?php foreach($profileOwner->educations()->orderBy('year_joined', 'desc')->get() as $education): ?>
				        <a href="javascript:;" class="list-group-item">
					        <h5 class="list-group-item-heading" style="font-weight: bold;">Major in <?=$education->major?></h5>
					        <p class="list-group-item-text">
						        <?=($education->is_current)?'Studying':'Graduated'?> from <?=$education->institution_name?>
						        <?=($education->is_current)?'since':'from'?> <?=$education->year_joined?> <?=($education->is_current)?'':' to '.$education->year_left?>
						        <?php if($profileOwner->is($this->auth->user())): ?>
							        <br/><br />
							        <button class="btn btn-xs btn-primary link-button" data-target="<?=$profileOwner->profile_uri.'/edit-education/'.$education->id?>">
								        <i class="fa fa-edit"></i> Edit
							        </button>
							        &nbsp;
							        <button class="btn btn-xs btn-default link-button" data-target="<?=base_url()?>user-actions/delete-education/<?=$education->id?>">
								        <i class="fa fa-times"></i> Delete
							        </button>
					            <?php endif; ?>
					        </p>
				        </a>
			        <?php endforeach; ?>
		        </div>
	        <?php endif; ?>

	        <?php if($profileOwner->hasWorks()): ?>
		        <h4>Work Experiences</h4>
		        <?php foreach($profileOwner->works()->orderBy('date_joined', 'desc')->get() as $work): ?>
	                <a href="javascript:;" class="list-group-item">
		                <h5 class="list-group-item-heading" style="font-weight: bold;"><?=$work->job_title?> at <?=$work->company_name?></h5>
		                <p class="list-group-item-text">
			                <?=($work->is_current)?'Working since':'Worked from'?> <?=$work->date_joined->format('Y')?> <?=($work->is_current)?'':' to '.$work->date_left->format('Y')?>
			                <?php if($profileOwner->is($this->auth->user())): ?>
				                <br/><br />
				                <button class="btn btn-xs btn-primary link-button" data-target="<?=$profileOwner->profile_uri.'/edit-work/'.$work->id?>">
					                <i class="fa fa-edit"></i> Edit
				                </button>
				                &nbsp;
				                <button class="btn btn-xs btn-default link-button" data-target="<?=base_url()?>user-actions/delete-work/<?=$work->id?>">
					                <i class="fa fa-times"></i> Delete
				                </button>
			                <?php endif; ?>
		                </p>
		            </a>
		        <?php endforeach; ?>
	        <?php endif; ?>
        <?php else: ?>
            <h3 class="text-center">No details provided !</h3>
        <?php endif; ?>
    </div><!--/.panel-body-->
    <?php if($profileOwner->is($this->auth->user())): ?>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12">
	                <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/add-work" class="btn btn-primary pull-right">
		                <i class="fa fa-plus-square"></i> Add work
	                </a>
	                <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/add-education" class="btn btn-primary pull-right" style="margin-right: 10px;">
		                <i class="fa fa-plus-square"></i> Add Education
	                </a>
                </div><!--/.col-md-12-->
            </div><!--/.row-->
        </div><!--/.panel-footer-->
    <?php endif; ?>
</div><!--/.panel-->

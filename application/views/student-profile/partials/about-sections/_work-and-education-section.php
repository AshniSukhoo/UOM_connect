<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-suitcase"></i> Work and Education</h4>
    </div><!--/.panel-heading-->
    <div class="panel-body">
        <?php if($profileOwner->hasWorkOrEduction()): ?>
        <?php else: ?>
            <h3 class="text-center">No details provided !</h3>
        <?php endif; ?>
    </div><!--/.panel-body-->
    <?php if($profileOwner->is($this->auth->user())): ?>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12">
                    <?php if($profileOwner->hasWorkOrEduction()): ?>
                        <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/edit-work-education" class="btn btn-primary pull-right">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    <?php else: ?>
                        <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/add-work" class="btn btn-primary pull-right">
                            <i class="fa fa-plus-square"></i> Add work
                        </a>
                        <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/add-education" class="btn btn-primary pull-right" style="margin-right: 10px;">
                            <i class="fa fa-plus-square"></i> Add Education
                        </a>
                    <?php endif; ?>
                </div><!--/.col-md-12-->
            </div><!--/.row-->
        </div><!--/.panel-footer-->
    <?php endif; ?>
</div><!--/.panel-->
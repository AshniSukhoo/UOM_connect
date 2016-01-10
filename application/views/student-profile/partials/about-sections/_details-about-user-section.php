<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-user"></i> Details about <?=($profileOwner->is($this->auth->user()))?'you':$profileOwner->full_name?></h4>
    </div><!--/.panel-heading-->
    <div class="panel-body">
        <?php if($profileOwner->hasDetails()): ?>
        <?php else: ?>
            <h3 class="text-center">No details provided !</h3>
        <?php endif; ?>
    </div><!--/.panel-body-->
    <?php if($profileOwner->is($this->auth->user())): ?>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/add-edit-details" class="btn btn-primary pull-right">
                        <?php if($profileOwner->hasDetails()): ?>
                            <i class="fa fa-edit"></i> Edit
                        <?php else: ?>
                            <i class="fa fa-plus-square"></i> Add details
                        <?php endif; ?>
                    </a>
                </div><!--/.col-md-12-->
            </div><!--/.row-->
        </div><!--/.panel-footer-->
    <?php endif; ?>
</div><!--/.panel-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-info"></i> Basic information</h4>
    </div><!--/.panel-heading-->
    <div class="panel-body">
        <ul class="list-group my-list-group">
            <li class="list-group-item">
                <i class="fa fa-calendar"></i> Born on <?=$profileOwner->date_of_birth->formatLocalized('%B %d, %Y') ?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-globe"></i> Country - <?=($profileOwner->basicInfo != null && $profileOwner->basicInfo->country != '')?$profileOwner->basicInfo->country:'No info provided'?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-building"></i> City - <?=($profileOwner->basicInfo != null && $profileOwner->basicInfo->city != '')?$profileOwner->basicInfo->city:'No info provided'?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-map-marker"></i> Address - <?=($profileOwner->basicInfo != null && $profileOwner->basicInfo->address != '')?$profileOwner->basicInfo->address:'No info provided'?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-envelope"></i> Email - <?=($profileOwner->basicInfo != null && $profileOwner->basicInfo->emails != null)?$profileOwner->basicInfo->show_emails:'No info provided'?>
            </li>
        </ul>
    </div><!--/panel-body-->
    <?php if($profileOwner->is($this->auth->user())): ?>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?=base_url()?>lecturer-profile/<?=$profileOwner->id?>/edit-basic-info" class="btn btn-primary pull-right">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </div><!--/.col-md-12-->
            </div><!--/.row-->
        </div><!--/.panel-footer-->
    <?php endif; ?>
</div><!--/.panel-default-->
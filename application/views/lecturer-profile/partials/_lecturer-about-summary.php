<div class="panel panel-default">
    <div class="panel-body">
        <ul class="list-group my-list-group">
            <li class="list-group-item">
                <i class="fa fa-university"></i> Faculty - <?=($profileOwner->uomId->faculties->count() != 0) ? $profileOwner->uomId->faculties()->first()->name : 'No info'?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-graduation-cap"></i> Course - <?=($profileOwner->uomId->courses->count() != 0) ? $profileOwner->uomId->courses()->first()->course_name : 'No info'?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-calendar"></i> Born on <?=($profileOwner->date_of_birth != null) ? $profileOwner->date_of_birth->formatLocalized('%B %d, %Y') : 'No info'?>
            </li>
        </ul>
    </div><!--/panel-body-->
</div><!--/panel-->

<?php $this->load->view('pages/partials/_post-advertisement-template') ?>

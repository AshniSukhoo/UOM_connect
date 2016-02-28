<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <img src="<?=$user->profile_picture?>" class="img-responsive">
            </div><!--/.col-md-4-->
            <div class="col-md-9">
                <?php if($user->user_type == 'student'): ?>
                    <ul class="list-group my-list-group">
                        <li class="list-group-item">
                            <i class="fa fa-university"></i> Faculty - Lorem ipsum
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-graduation-cap"></i> Course - lorem nam
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-calendar"></i> Born on <?=$profileOwner->date_of_birth->formatLocalized('%B %d, %Y') ?>
                        </li>
                    </ul>
                <?php else: ?>
                <?php endif; ?>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </div><!--/.panel-body-->
</div><!--/.panel panel-default-->

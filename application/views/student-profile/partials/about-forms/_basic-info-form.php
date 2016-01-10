<form method="post" action="<?=base_url()?>user-actions/save-basic-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-info"></i> Editing basic information</h4>
        </div><!--/.panel-heading-->
        <div class="panel-body">

        </div><!--/panel-body-->
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/about" class="btn btn-default">
                        <i class="fa fa-times"></i> Cancel
                    </a>
                </div><!--/.col-md-12-->
            </div><!--/.row-->
        </div><!--/.panel-footer-->
    </div><!--/.panel-default-->
</form>
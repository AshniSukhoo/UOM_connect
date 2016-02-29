<div class="well post-status-well">
    <form action="<?=base_url('posts/create-new')?>" method="post" class="form-horizontal post-status-form" role="form">
        <h4>What's New</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <textarea class="form-control post-status-area" name="post" placeholder="Update your status" style="height: 70px;"></textarea>
                </div><!--/.form-group-->
                <div class="form-group" style="text-align: right;">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-paper-plane"></i> Post
                    </button><!--/.btn-primary-->
                </div><!--/.form-group-->
            </div><!--/.col-md-12-->
        </div><!--/.row-->
        <!--<ul class="list-inline">
            <li>
                <a href="">
                    <i class="fa fa-camera"></i>
                </a>
            </li>
        </ul><!--/.list-inline-->
    </form><!--/.form-->
</div><!--/well-->
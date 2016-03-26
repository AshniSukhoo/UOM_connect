<?php $this->load->view('template/_header') ?>

<!-- content -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="<?=base_url('update-password')?>" method="POST" role="form" autocomplete="off">
                        <div class="form-group <?=$this->keeper->has('current_password_error') ? 'has-error' : ''?>">
                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter your current password" />
                            <?=($this->keeper->has('current_password_error'))?$this->keeper->get('current_password_error'):''?>
                        </div><!--/.form-group-->

                        <div class="form-group  <?=$this->keeper->has('new_password_error') ? 'has-error' : ''?>">
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter your new password" />
                            <?=($this->keeper->has('new_password_error'))?$this->keeper->get('new_password_error'):''?>
                        </div><!--/.form-group-->

                        <div class="form-group <?=$this->keeper->has('confirm_new_password_error') ? 'has-error' : ''?>">
                            <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" placeholder="Confirm your new password" />
                            <?=($this->keeper->has('confirm_new_password_error'))?$this->keeper->get('confirm_new_password_error'):''?>
                        </div><!--/.form-group-->

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i>  Ok
                            </button>
                        </div><!--/.form-group-->
                    </form>
                </div><!--/.panel-body-->
            </div><!--/.panel panel-default-->
        </div><!--/.col-md-8  col-md-offset-2-->
    </div><!--/.row-->
</div><!--/.container-->

<?php $this->load->view('template/_footer') ?>

<?php $this->load->view('template/_closing-body') ?>


<?php $this->load->view('pages/partials/_header', ['title' => 'Password reset']) ?>

<div class="row">

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" style="margin-top: 50px;">
            <?php if(! $this->keeper->has('notificationSuccess')) : ?>
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-key"></i> Enter and confirm your new password
                    </h3>
                </div>
            <?php endif; ?>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($this->keeper->has('notificationSuccess')) : ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=$this->keeper->get('notificationSuccess')?>
                            </div>
                            <div class="form-group text-center">
                                <a href="<?=base_url()?>" class="btn btn-primary">
                                    <i class="fa fa-home"></i> Home
                                </a>
                            </div><!--/.form-group-->
                        <?php else: ?>
                            <form action="<?=base_url('passwords/change-password/'.$token->code)?>" method="post" autocomplete="off">
                                <div class="form-group <?=$this->keeper->has('password_error') ? 'has-error' : ''?>">
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control"
                                           placeholder="Enter your new password"
                                        />
                                    <?=($this->keeper->has('password_error'))?$this->keeper->get('password_error'):''?>
                                </div><!--/.form-group-->
                                <div class="form-group <?=$this->keeper->has('confirm_password_error') ? 'has-error' : ''?>">
                                    <input type="password"
                                           name="confirm_password"
                                           id="confirm_password"
                                           class="form-control"
                                           required="required"
                                           placeholder="Confirm new password"
                                    />
                                    <?=($this->keeper->has('confirm_password_error'))?$this->keeper->get('confirm_password_error'):''?>
                                </div><!--/.form-group-->
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-keyboard-o"></i> Change password
                                    </button>
                                </div><!--/.form-group-->
                            </form>
                        <?php endif; ?>
                    </div><!--/.col-md-12-->
                </div><!--/.row-->
            </div><!--/.panel-body-->
        </div><!--/.panel-->
    </div><!--/.col-md-8 col-md-offset-2-->

</div><!--/.row-->

<?php $this->load->view('pages/partials/_footer') ?>

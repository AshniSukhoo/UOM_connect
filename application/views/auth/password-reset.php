<?php $this->load->view('pages/partials/_header', ['title' => 'Password reset']) ?>

<div class="row">

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" style="margin-top: 50px;">
            <?php if(! $this->keeper->has('notificationSuccess')) : ?>
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-key"></i> Enter your email address and we will send you a link to reset your password
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
                            <form action="<?=base_url('passwords/send-reset')?>" method="post">
                                <div class="form-group <?=$this->keeper->has('email_error') ? 'has-error' : ''?>">
                                    <input type="text"
                                           name="email"
                                           id="email"
                                           class="form-control"
                                           placeholder="Enter your email"
                                           value="<?=$this->auth->check() ? $this->auth->user()->email : ($this->keeper->has('email_value') ? $this->keeper->get('email_value') : '')?>"
                                        <?=$this->auth->check() ? 'readonly' : ''?>
                                        />
                                    <?=($this->keeper->has('email_error'))?$this->keeper->get('email_error'):''?>
                                </div><!--/.form-group-->
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-paper-plane"></i> Send
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

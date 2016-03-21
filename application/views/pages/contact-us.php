<?php $this->load->view('pages/partials/_header', ['title' => 'Contact us']) ?>

<div class="row">

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" style="margin-top: 50px;">
            <?php if(! $this->keeper->has('notificationSuccess')) : ?>
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-question-circle"></i> Need Help - Fill the form and we will get back to you as soon as possible
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
                            <form id="contact-form" name="contact-form" method="post" action="<?=base_url('send-contact')?>">
                                <div class="form-group <?=$this->keeper->has('first_name_error') ? 'has-error' : ''?>">
                                    <input type="text"
                                           name="first_name"
                                           id="first_name"
                                           placeholder="Your first name"
                                           class="form-control"
                                           value="<?=$this->auth->check() ? $this->auth->user()->first_name : ($this->keeper->has('first_name_value') ? $this->keeper->get('first_name_value') : '')?>"
                                        <?=$this->auth->check() ? 'readonly': ''?>
                                        />
                                    <?=($this->keeper->has('first_name_error'))?$this->keeper->get('first_name_error'):''?>
                                </div><!--/.form-group-->

                                <div class="form-group <?=$this->keeper->has('last_name_error') ? 'has-error' : ''?>">
                                    <input type="text"
                                           name="last_name"
                                           id="last_name"
                                           placeholder="Your last name"
                                           class="form-control"
                                           value="<?=$this->auth->check() ? $this->auth->user()->last_name : ($this->keeper->has('last_name_value') ? $this->keeper->get('last_name_value') : '')?>"
                                        <?=$this->auth->check() ? 'readonly': ''?>
                                        />
                                    <?=($this->keeper->has('last_name_error'))?$this->keeper->get('last_name_error'):''?>
                                </div><!--/.form-group-->

                                <div class="form-group <?=$this->keeper->has('email_error') ? 'has-error' : ''?>">
                                    <input type="text"
                                           name="email"
                                           id="email"
                                           class="form-control"
                                           placeholder="Your email address"
                                           value="<?=$this->auth->check() ? $this->auth->user()->email : ($this->keeper->has('email_value') ? $this->keeper->get('email_value') : '')?>"
                                        <?=$this->auth->check() ? 'readonly': ''?>
                                        />
                                    <?=($this->keeper->has('email_error'))?$this->keeper->get('email_error'):''?>
                                </div><!--/.form-group-->

                                <div class="form-group <?=$this->keeper->has('message_error') ? 'has-error' : ''?>">
                                    <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Compose your message..."><?=($this->keeper->has('message_value'))?$this->keeper->get('message_value'):''?></textarea>
                                    <?=($this->keeper->has('message_error'))?$this->keeper->get('message_error'):''?>
                                </div><!--/.form-group-->

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-paper-plane"></i> Send Message
                                    </button>
                                </div><!--/.form-group-->
                            </form>
                        <?php endif; ?>
                    </div><!--/.col-md-12-->
                </div><!--/.row-->
            </div><!--/.panel-body-->
        </div><!--/.panel-->
    </div><!--/.col-md-12-->

</div><!--/.row-->

<?php $this->load->view('pages/partials/_footer') ?>


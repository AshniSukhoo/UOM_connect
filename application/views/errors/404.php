<?php $this->load->view('pages/partials/_header', ['title' => 'Page not Found']) ?>

<div class="row">

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" style="margin-top: 50px;">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-warning"></i> Sorry, this content isn't available right now
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <p>
                            The link you followed may have expired, or the page may only be visible to an audience you're not in.
                        </p>
                        <a class="active" href="<?=$this->agent->referrer()?>">Go back to previous page</a> .
                        <a class="active" href="<?=base_url()?>">Homepage</a> .
                        <a class="active" href="<?=base_url('contact-us')?>">Contact us</a>
                    </div><!--/.col-md-8 col-md-offset-2-->
                </div><!--/.row-->
            </div><!--/.panel-body-->
        </div><!--/.panel-->
    </div><!--/.col-md-8 col-md-offset-2-->

</div><!--/.row-->

<?php $this->load->view('pages/partials/_footer') ?>

<?php $this->load->view('pages/partials/_header', ['title' => $content->title]) ?>

<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default" style="margin-top: 50px;">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <?=$content->text?>
                    </div><!--/.col-md-12-->
                </div><!--/.row-->
            </div><!--/.panel-body-->
        </div><!--/.panel-->
    </div><!--/.col-md-12-->

</div><!--/.row-->

<?php $this->load->view('pages/partials/_footer') ?>

<?php $this->load->view('template/_header', [
    'css' => ['/css/bootstrap-tagsinput.css'],
    'hasAd' => true
]) ?>
<style type="text/css">
    .bootstrap-tagsinput {
        width: 100% !important;
        border-bottom-left-radius: 0px;
        border-top-left-radius: 0px;
    }
    .bootstrap-tagsinput input {
        width: 100% !important;
    }
</style>

<!-- content -->
<div class="container">
    <?php $this->load->view('lecturer-profile/partials/_profile-summary') ?>

    <div class="row">
        <div class="col-md-4">
            <?php $this->load->view('lecturer-profile/partials/_lecturer-about-summary') ?>
        </div><!--/.col-md-4-->

        <div class="col-md-8">
            <?php $this->load->view('lecturer-profile/partials/_profile-navigation') ?>

            <?php $this->load->view('lecturer-profile/partials/about-forms/_basic-info-form') ?>

            <?php $this->load->view('lecturer-profile/partials/about-sections/_work-and-education-section') ?>

            <?php $this->load->view('lecturer-profile/partials/about-sections/_details-about-user-section') ?>
        </div><!--/.col-md-8-->

    </div><!--/.row-->

</div><!--/.container-->

<?php $this->load->view('template/_footer', ['js_plugins' => [
    '/js/plugins/tags-input/bootstrap-tagsinput.js',
]]) ?>

<?php $this->load->view('lecturer-profile/partials/_js-common') ?>

<script type="text/javascript">
    $(document).ready(function() {

        $('input[name="emails"]').tagsinput();

        $('input[name="country"]').focus();
    });
</script>

<?php $this->load->view('template/_closing-body') ?>

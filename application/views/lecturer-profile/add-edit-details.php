<?php $this->load->view('template/_header', [
    'css' => [
        '/css/bootstrap-tagsinput.css'
    ],
    'hasAd' => true
]); ?>
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

            <?php $this->load->view('lecturer-profile/partials/about-forms/_add-edit-details') ?>

            <?php $this->load->view('lecturer-profile/partials/about-sections/_basic-info-section') ?>

            <?php $this->load->view('lecturer-profile/partials/about-sections/_work-and-education-section') ?>

        </div><!--/.col-md-8-->

    </div><!--/.row-->

</div><!--/.container-->

<?php $this->load->view('template/_footer', [
    'js_plugins' => [
        '/js/plugins/autogrow/jquery.autogrowtextarea.min.js',
        '/js/plugins/tags-input/bootstrap-tagsinput.js',
    ]
]) ?>

<?php $this->load->view('lecturer-profile/partials/_js-common') ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.tags-input').tagsinput();

        $('input[name="hobbies"]').focus();

        $('textarea[name="about"]').autoGrow();
    });
</script>

<?php $this->load->view('template/_closing-body') ?>

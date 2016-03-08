<?php $this->load->view('template/_header', [
    'hasAd' => true,
]); ?>
<!-- content -->
<div class="container">
    <?php $this->load->view('lecturer-profile/partials/_profile-summary') ?>

    <div class="row">
        <div class="col-md-4">
            <?php $this->load->view('lecturer-profile/partials/_lecturer-about-summary') ?>
        </div><!--/.col-md-4-->

        <div class="col-md-8">
            <?php $this->load->view('lecturer-profile/partials/_profile-navigation') ?>

            <?php if(isset($handle) && $handle == 'add'): ?>
                <?php $this->load->view('lecturer-profile/partials/about-forms/_add-education') ?>
            <?php endif; ?>

            <?php if(isset($handle) && $handle == 'edit'): ?>
                <?php $this->load->view('lecturer-profile/partials/about-forms/_edit-education') ?>
            <?php endif; ?>

            <?php $this->load->view('lecturer-profile/partials/about-sections/_basic-info-section') ?>

            <?php $this->load->view('lecturer-profile/partials/about-sections/_details-about-user-section') ?>
        </div><!--/.col-md-8-->

    </div><!--/.row-->

</div><!--/.container-->

<?php $this->load->view('template/_footer', [
    'js_plugins' => [
        '/js/plugins/autogrow/jquery.autogrowtextarea.min.js',
    ]
]); ?>

<?php $this->load->view('lecturer-profile/partials/_js-common') ?>

<script type="text/javascript">
    $(document).ready(function(){
        $(".post-status-area").autoGrow();

        $('input[name="emails"]').tagsinput();

        $('input[name="institution_name"]').focus();
    });
</script>

<?php $this->load->view('template/_closing-body') ?>

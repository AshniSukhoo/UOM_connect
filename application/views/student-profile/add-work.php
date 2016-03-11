<?php $this->load->view('template/_header', [
    'css' => [
        '/css/bootstrap-datetimepicker.css',
    ],
    'hasAd' => true,
]); ?>
    <!-- content -->
    <div class="container">
        <?php $this->load->view('student-profile/partials/_profile-summary') ?>

        <div class="row">
            <div class="col-md-4">
                <?php $this->load->view('student-profile/partials/_student-about-summary') ?>
            </div><!--/.col-md-4-->

            <div class="col-md-8">
                <?php $this->load->view('student-profile/partials/_profile-navigation') ?>

                <?php if(isset($handle) && $handle == 'add'): ?>
	                <?php $this->load->view('student-profile/partials/about-forms/_add-work') ?>
                <?php endif; ?>

                <?php if(isset($handle) && $handle == 'edit'): ?>
	                <?php $this->load->view('student-profile/partials/about-forms/_edit-work') ?>
                <?php endif; ?>


                <?php $this->load->view('student-profile/partials/about-sections/_basic-info-section') ?>

                <?php $this->load->view('student-profile/partials/about-sections/_details-about-user-section') ?>
            </div><!--/.col-md-8-->

        </div><!--/.row-->

    </div><!--/.container-->

<?php $this->load->view('template/_footer', [
    'js_plugins' => [
        '/js/plugins/moment/min/moment-with-locales.min.js',
        '/js/plugins/datetimepicker/bootstrap-datetimepicker.js'
    ]
]); ?>

	<?php $this->load->view('student-profile/partials/_js-common') ?>

    <script type="text/javascript">
        $(document).ready(function() {

            $('input[name="job_title"]').focus();

	        $('.datepicker').datetimepicker({
		        viewMode: 'years',
		        format: 'DD/MM/YYYY',
		        maxDate: moment()
	        });
        });
    </script>

<?php $this->load->view('template/_closing-body') ?>

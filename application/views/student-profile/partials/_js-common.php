<script type="text/javascript">
	$(document).ready(function() {

		<?php if($profileOwner->is($this->auth->user())): ?>
			$('#changeProfilePic').on('click', function(e) {
				$(this).blur();
				$('input[name="profile-picture"]').click();
			});

			$('input[name="profile-picture"]').on('change', function() {
				var formInformation = new FormData(document.getElementById("change-picture-form"));

				$.ajax({
					url: '<?=base_url()?>preview/200/200',
					type: 'POST',
					data: formInformation,
					dataType: 'json',
					async: true,
					enctype: 'multipart/form-data',
					processData:false,
					contentType:false,
					beforeSend:function() {
					},
					success:function(data){
					}
				});
			});
		<?php endif; ?>

	});
</script>
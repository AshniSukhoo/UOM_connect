<script type="text/javascript">
	$(document).ready(function() {

		<?php if($this->auth->check() && $this->auth->user()->is($profileOwner)): ?>
			$('#changeProfilePic').on('click', function(e) {
				$(this).blur();
				$('input[name="profile_picture"]').click();
			});

			function hideProfilePicActions() {
				$('#btn-save-profile-pic').addClass('hidden');
				$('#btn-cancel-profile-pic').addClass('hidden');
			}

			function showProfilePicactions() {
				$('#btn-save-profile-pic').removeClass('hidden');
				$('#btn-cancel-profile-pic').removeClass('hidden');
			}

			$('#btn-cancel-profile-pic').on('click', function(e) {
				e.preventDefault();
				hideProfilePicActions();
				document.getElementById("change-picture-form").reset();
				$('#img-profile-pic').attr('src', previousProfilePicSrc);
			});

			var previousProfilePicSrc = '';

			$('input[name="profile_picture"]').on('change', function() {
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
						previousProfilePicSrc = $('#img-profile-pic').attr('src');
					},
					success:function(data) {
						if(data.error != true) {
							$('#img-profile-pic').attr('src', data.data);
							showProfilePicactions();
						}
					}
				});
			});
		<?php endif; ?>

		<?php if($this->auth->check() && $this->auth->user()->isNot($profileOwner)): ?>

			$('.profile-actions-container').on('click', '.add-friend', function(e) {
				var thisButton = $(this);
				var user_id = $(this).attr('data-user-id');
				var replacementButton = '';
				$.ajax({
					url: '<?=base_url('user-actions/add-friend')?>',
					type: 'POST',
					dataType: 'JSON',
					data: {user_id:user_id},
					beforeSend: function() {
						replacementButton = '<?=Html::cancelFriendRequestButton()?>';
						replacementButton.replace(/:userId/g, ':userId')
						$('.profile-actions-container').html(replacementButton);
					},
					success: function(data) {
						if(data.error) {
							replacementButton = '<?=Html::addAsFriendButton()?>';
							replacementButton.replace(/:userId/g, ':userId')
							$('.profile-actions-container').html(replacementButton);
						}
					}
				});
			});
		<?php endif; ?>
	});
</script>
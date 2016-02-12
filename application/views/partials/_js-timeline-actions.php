<script type="text/javascript">
	var nextPageUrl = '<?=$nextPageUrl?>';
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".post-status-area").autoGrow();

		$(".posts-container").on('click', '.like-action', function(e) {
			e.preventDefault();
			var likeButton = $(this);
			$.ajax({
				url: '<?=base_url()?>posts/like',
				dataType: 'JSON',
				type: 'POST',
				data: {post_id:likeButton.attr('data-post-id')},
				beforeSend: function() {
					likeButton.addClass('active');
					likeButton.blur();
				},
				success: function(data) {

				}
			});
		});

		$('.posts-container').on('click', '.more-comments', function(e) {
			e.preventDefault();
			var loader = '<?=Html::moreCommentsLoader()?>';
			var more_comments = $(e.target);
			var comments_container = more_comments.parents('.panel-footer').first().find('.comments-container');
			var prevMoreCommentsButton = more_comments.parents('.row').first();
			$.ajax({
				url: more_comments.attr('href'),
				type: 'GET',
				dataType: 'JSON',
				beforeSend: function() {
					more_comments.parents('.row').first().remove();
					comments_container.prepend(loader);
				},
				success: function(data) {
					if(data.error == false) {
						comments_container.prepend(data.comments);
					} else {
						comments_container.prepend(prevMoreCommentsButton);
						alertError(data.message);
					}
				}
			}).always(function() {
				comments_container.find('.more-comments-loader').remove();
			});
		});

		function nextResults() {
			if(($('#main').scrollTop() + $('#main').innerHeight() >= $('#main')[0].scrollHeight) && (nextPageUrl != null)) {
				$.ajax({
					url: nextPageUrl,
					type: 'GET',
					dataType: 'JSON',
					beforeSend: function() {
						$('#main').off('scroll', nextResults);
						$('.posts-container').append('<?=Html::morePostsLoader()?>');
					},
					success: function(data) {
						if(data.error == false) {
							$('.posts-container').append(data.grid);
							nextPageUrl = data.nextPageUrl;
						} else {
							alertError(data.message);
						}
					}
				}).always(function() {
					$('.posts-container').find('.more-posts-loader').remove();
					$('#main').on('scroll', nextResults);
				});
			}
		}
		$('#main').on('scroll', nextResults);
	});
</script>
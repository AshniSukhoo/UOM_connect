<?php if($comments->hasMorePages()): ?>
	<?php $this->load->view('partials/_more-comments-button', [
		'nextPageUrl' => $comments->nextPageUrl()
	]) ?>
<?php endif; ?>

<?php foreach($comments->reverse()->all() as $comment) {
	$this->load->view('partials/_single-comment-row', [
		'comment' => $comment
	]);
} ?>
<?php

foreach($posts as $post) {
	$this->load->view('partials/_single-post', ['post' => $post]);
}
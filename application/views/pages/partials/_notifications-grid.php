<?php

foreach ($notifications as $notification):
    $this->load->view('pages/partials/_single-notification', compact('notification'));
endforeach;

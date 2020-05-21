<?php

function status_success($message) {
    return array(
        'success' => TRUE,
        'message' => $message
    );
}

function status_failure($message) {
    return array(
        'success' => FALSE,
        'message' => $message
    );
}

function status_succeeded($status) {
    return $status['success'] === TRUE;
}

function status_failed($status) {
    return !status_succeeded($status);
}

function status_message($status) {
    if (isset($status)) {
        $bg_color = status_succeeded($status) ? 'w3-pale-green' : 'w3-pale-red';
        $border_color = status_succeeded($status) ? 'w3-border-green' : 'w3-border-red';

        echo '<div class="w3-padding w3-leftbar '.$bg_color.' '.$border_color.'">';
        echo ' <div class="w3-margin">';
        echo '  '.$status['message'];
        echo ' </div>';
        echo '</div>';
    }
}

?>

<?php
function getMessages() {
    $file = 'chat_history.txt';
    if (file_exists($file)) {
        $messages = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $messages;
    }
    return [];
}

$messages = getMessages();
foreach ($messages as $message) {
    echo '<div class="message">' . $message . '</div>';
}
?>

<?php
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function ensureLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: ../views/login.php');
        exit();
    }
}

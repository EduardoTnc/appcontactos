<?php

require_once 'config/db.php';

session_start();
    
if (isset($_SESSION['user_id'])) {
    header('Location: '. APP_URL .'views/dashboard.php');
    exit();
} else {
    header('Location: '. APP_URL .'views/login.php');
    exit();
}

<?php
    session_start();
    if (isset($_GET['oauth_consumer_key'])) {
        $_SESSION["oauth_consumer_key"] = $_GET['oauth_consumer_key'];
        $_SESSION["success_call_back"]  = $_GET['success_call_back'];

        header("Location: " . $_GET['success_call_back']);
        die();
    }

    if (!empty($_POST)) {
        echo '<pre>';
        echo 'POST DATA <br>';
        print_r($_POST);

        echo 'Session DATA <br>';
        print_r($_SESSION);
    }

    die();
?>

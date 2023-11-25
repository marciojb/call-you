<?php

function logout() {
    session_start();
    session_unset();
    session_destroy();
    header("location: ../paginas/index.php");
}


























?>
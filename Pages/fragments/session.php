<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['success'])) {
    
    echo "<div class='flash-message success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
    
   
    unset($_SESSION['success']);
}


if (isset($_SESSION['error'])) {
    echo "<div class='flash-message error'>" . htmlspecialchars($_SESSION['error']) . "</div>";
    unset($_SESSION['error']);
}
?>
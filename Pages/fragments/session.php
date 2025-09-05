  <?php
    session_status() === PHP_SESSION_NONE ? session_start() : null;

    if (isset($_SESSION['success'])) {
        echo "<div class='flash-message success'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {
        echo "<div class='flash-message error'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>
  <!-- 
 <?php
    session_status() === PHP_SESSION_NONE ? session_start() : null;

    if (isset($_SESSION['success'])) {
        echo "<div class='flash-message success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {
        echo "<div class='flash-message error'>" . htmlspecialchars($_SESSION['error']) . "</div>";
        unset($_SESSION['error']);
    }
    ?> -->

<?php
session_start();
if (!isset($_SESSION["office"])) {
    header("Location: ../../index.php");
}

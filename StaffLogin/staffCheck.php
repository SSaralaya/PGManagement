<?php
session_start();

    if(!isset($_SESSION["staff"])){
        header("Location: ../index.php");
    }
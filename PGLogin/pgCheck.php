<?php
session_start();

    if(!isset($_SESSION["pg"])){
        header("Location:../index.php");
    }
<?php
 $maincon=new mysqli("localhost","root","","dboffice");

 if($maincon->connect_error){
    echo "<script>alert('DB Error')</script>";
 }

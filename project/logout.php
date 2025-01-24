<?php

session_start();

if(isset($_SESSION['dproject_userid']))
{
    $_SESSION['dproject_userid']= NULL;
    unset($_SESSION['dproject_userid']);
}


header("Location:login.php");
die;
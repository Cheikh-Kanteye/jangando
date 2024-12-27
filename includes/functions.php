<?php
function checkSession()
{
  if (!isset($_SESSION['role'])) {
    require "./views/login.php";
    exit;
  }
}

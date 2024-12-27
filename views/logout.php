<?php
$_SESSION = [];
session_destroy();
echo "<script>window.location.href='/login'</script>";
exit;

<?php
// filepath: c:\laragon\www\UTS_pemweb\logout.php
session_start();
session_destroy();
header('Location: login.php');
exit;
?>
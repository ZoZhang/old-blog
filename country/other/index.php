<?php
header('Content-Type:text/html;charset=utf8');
session_start();
$country_name = $_SESSION['country_name'];
echo '<center>欢迎您来自'. $country_name . '游客!</center>';

?>
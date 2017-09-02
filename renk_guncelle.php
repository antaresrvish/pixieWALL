<?php
if (!isset($_SERVER['HTTP_REFERER']))
	exit;

if (strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'])===FALSE)
	exit;


include 'veritabani.php';
$sorgu="update pixwall set renk='".$_POST['renk']."' where hucre='".$_POST['hucre']."' ";
$gonder=mysqli_query($baglanti,$sorgu);
if ($gonder && mysqli_affected_rows($baglanti)==1)
	echo 'ok';

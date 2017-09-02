<?php
session_start();

//echo date('Y-m-d H:i:s');

if (!$_SESSION['son_guncelleme'])
{
	$_SESSION['son_guncelleme']=date('Y-m-d H:i:s');
	halt;
}
include 'veritabani.php';
include 'fonksiyonlar.php';



$veri = '{ ';

$sorgu="select * from pixwall where guncelleme>'".$_SESSION['son_guncelleme']."'";
$gonder = mysqli_query($baglanti,$sorgu);
while ($row=mysqli_fetch_array($gonder))
{
	$veri .= '"'.$row['hucre'].'":"'.$row['renk'].'",';
}
$veri = substr($veri,0,strlen($veri)-1) .  '}';
echo $veri;
$_SESSION['son_guncelleme']=tarih();
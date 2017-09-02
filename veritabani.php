<?php
$baglanti = mysqli_connect('localhost','kiracbi2_pixwall','pixwall123');

if (!$baglanti)
	echo 'Bağlanılamadı';

$veritabani = mysqli_select_db($baglanti,'kiracbi2_pixwall');

if (!$veritabani)
	echo 'Veritabanı seçilemedi';

$GLOBALS['baglanti']=$baglanti;


/*
	for ($i=1;$i<=10000;$i++)
	{
		$sorgu="insert into pixwall (hucre,renk) values (".$i.",'white')";
		$gonder=mysqli_query($baglanti,$sorgu);
	}
*/

?>
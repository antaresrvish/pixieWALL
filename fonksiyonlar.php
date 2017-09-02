<?php

function toplamTiklama()
{

	$sorgu="select deger from istatistik where anahtar='tiklama'";
	$gonder = mysqli_query($GLOBALS['baglanti'],$sorgu);
	$row=mysqli_fetch_array($gonder);
	return $row['deger'];
}

function tarih()
{
	$date=date("Y-m-d H:i:s");
	return date("Y-m-d H:i:s", strtotime($date) - 60);
}
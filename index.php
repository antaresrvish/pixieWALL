<?php
include 'fonksiyonlar.php';
include 'veritabani.php';
?>
<html>
<head>
	<title>pixWALL</title>
	<style type="text/css">
		body{background:#f3f3f3;background:url('images/back.png');background-size: cover;}
		.anahat {width: 600px; margin: 0 auto; border: 1px solid gray;background: rgba(255,255,255,.95);box-shadow: 0px 0px 5px 5px black;}
		.anahat:after {content:'';display:block;clear:both;}
		#tuval {border-top: 10px solid black;transition: 10s;}
		div#tuval div.k {width: 5px; height: 5px; border-right: 1px solid #f3f3f3;border-bottom:1px solid #f3f3f3;float:left;}
		div#tuval div.k:hover {border-bottom: 1px solid red;border-right:1px solid red;}
		div#tuval div.k:nth-child(100n+1) {clear:left;}
		
		/*#renkSecim {display:none;}*/
		#renkSecim {background:#f3f3f3;margin-bottom:3px;}
		#renkSecim:after {content:'';display:block;clear:both;}
		#renkSecim .renk {width:47px;height:50px;display:block;float:left;border: 1px solid black;cursor:pointer;margin:5px;border-radius:5px;box-shadow: 3px 3px 3px gray;}
		#renkSecim #red {box-shadow: none; margin: 8px 2px 2px 8px;}
		
		#tiklama {text-align: center; font-family: 'trebuchet ms';line-height: 50px;margin-top:-20px;}
		#tiklama span {background-color:#000;color:#fff;border-radius: 50%;padding:15px;border: 3px solid yellow;width: 50px; display: inline-block;box-shadow: 0px 0px 5px 1px black;}
		
		.temizle {clear:both;}
	</style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
  	<script type="text/javascript">
	$(document).ready(function() {
		var sonSecim=null;
		 var sonGuncelleme='<?php echo date('Y-m-d H:i:s'); ?>';
		 var secilenRenk='red';

		 
		$( ".renk" ).each(function(  ) {
			$(this).css('background-color',this.id);
		  });
		
		
		/* RENKLENDİR */
		function renklendir(hucre,renk)
		{
			$('#'+hucre).css('background-color',renk);
		}
		
		/* RENK SEÇİMİ */
		$('.renk').click(function() {
			$('.renk').each(function(index) {
				$(this).css('box-shadow','3px 3px 3px gray').css('margin','5px');
			});
			
			
			$(this).css('box-shadow','none').css('margin','8px 2px 2px 8px');
			secilenRenk = this.id;
			$('#tuval').css('border-top','10px solid '+secilenRenk);
			
		});
		
		/* RENK SEÇİMİ */
		$('.k').click(function() {
			sonSecim=this.id;
			var eskiRenk = $('#'+sonSecim).css('background-color');
			renklendir(sonSecim,secilenRenk);
			 $.ajax({
			  method: "POST",
			  url: "renk_guncelle.php",
			  data: { hucre: sonSecim, renk: secilenRenk }
			})
			  .done(function( msg ) {
				if (msg!='ok')
				{
					console.log('Renklendirme geri alınıyor.'+msg);
					renklendir(sonSecim,eskiRenk);
				}
				else
					console.log(msg);
			  });
		});

		
		(function zamanlayici() {
		  $.ajax({
			method: "POST",
			url: 'hucre_kontrol.php',
			data: { },
			success: function(data) {
			  var veri = JSON.parse(data);
			      $.each(veri, function (hucre, renk) {
					renklendir(hucre,renk);
				   });
			},
			complete: function() {
			  setTimeout(zamanlayici, 3000);
			}
		  });
		  $.ajax({
			method: "POST",
			url: 'tiklama_sayisi.php',
			success: function(data) {
				$('#tiklamaSayi').html(data);
			}
		  });
		})();
		
	});
	</script>
  
</head>
<body>

<div class="anahat">
	<div id="tiklama">Şu ana kadar <span id="tiklamaSayi"><?php echo toplamTiklama();?></span>	tıklama</div>
	<div id="renkSecim">
		<span class="renk" id="red"></span>
		<span class="renk" id="green"></span>
		<span class="renk" id="blue"></span>
		<span class="renk" id="yellow"></span>
		<span class="renk" id="gray"></span>
		<span class="renk" id="purple"></span>
		<span class="renk" id="pink"></span>
		<span class="renk" id="orange"></span>
		<span class="renk" id="black"></span>
		<span class="renk" id="white"></span>
		
	</div>

	
	<div id="tuval">
	<?php
		
		$sorgu="select * from pixwall";
		$gonder=mysqli_query($baglanti,$sorgu);
		while ($row=mysqli_fetch_array($gonder))
		{
			?>
			<div class="k" id="<?php echo $row['hucre']; ?>" style="background-color: <?php echo $row['renk']; ?>"></div>
			<?php
		}
	?>
	</div>
</div>





</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MAKALE PROJECT</title>
	<style>
        body{
            background-image: url('image/arkaplan1.jpg');
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            opacity: 0.5;
        }
    </style>
</head>
<body style="color: white;font-size: 42px;margin-right: auto;margin-left: auto;text-align: center;">
	
<?php
require_once("connection.php");

$GelenCevap		=	Filtre($_POST["cevap"]);

$KontrolSorgusu		=	$pdo->prepare("SELECT * FROM oykullananlar WHERE ipadresi = ? AND tarih >= ?");
$KontrolSorgusu->execute([$IPAdresi, $ZamaniGeriAl]);
$KontrolSayisi		=	$KontrolSorgusu->rowCount();

if($KontrolSayisi>0){
	echo "HATA<br />";
	echo "Daha önce oy kullanmışsınız. Lütfen en az 24 saat sonra tekrar deneyiniz.<br />";
	echo "Anasayfaya dönmek için <p style='color:white'><a href='HomePage.php'>tıklayınız.</a></p>";
}else{
	if($GelenCevap==1){
		$Guncelle	=	$pdo->prepare("UPDATE anket SET oybir=oybir+1, toplamoysayisi=toplamoysayisi+1");
		$Guncelle->execute();
	}elseif($GelenCevap==2){
		$Guncelle	=	$pdo->prepare("UPDATE anket SET oyiki=oyiki+1, toplamoysayisi=toplamoysayisi+1");
		$Guncelle->execute();
	}elseif($GelenCevap==3){
		$Guncelle	=	$pdo->prepare("UPDATE anket SET oyüc=oyüc+1, toplamoysayisi=toplamoysayisi+1");
		$Guncelle->execute();
	}else{
		echo "HATA<br />";
		echo "Cevap Kaydı Bulunamıyor.<br />";
		echo "Anasayfaya dönmek için <a href='index.php' style='color:white'>tıklayınız.</a>";
	}
	
	$Ekle			=	$pdo->prepare("INSERT INTO oykullananlar (ipadresi, tarih) values (?, ?)");
	$Ekle->execute([$IPAdresi, $ZamanDamgasi]);
	$EkleKontrol	=	$Ekle->rowCount();
	
	if($EkleKontrol>0){
		echo "TEŞEKKÜRLER<br />";
		echo "Vermiş Olduğunuz Oy Sisteme Kaydedildi.<br />";
		echo "Anasayfaya dönmek için <a href='HomePage.php' style='color:white'>tıklayınız.</a>";

	}else{
		echo "HATA<br />";
		echo "İşlem Sırasında Beklenmeyen Bir Hata Oluştu. Lütfen Daha Sonra Tekrar Deneyiniz<br />";
		echo "Anasayfaya dönmek için <a href='index.php' style='color:white'>tıklayınız.</a>";
	}
}

$pdo	=	null;
?>

</body>
</html>
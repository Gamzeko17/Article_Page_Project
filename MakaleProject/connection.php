<?php

try{
    $pdo = new PDO("mysql:host=localhost;dbname=makaleproject;charset=UTF8","root","");
}catch(PDOException $Hata){
    echo "HATA".$Hata->getMessage();
    die();
}

function Filtre($Deger){
	$Bir	=	trim($Deger);
	$Iki	=	strip_tags($Bir);
	$Uc		=	htmlspecialchars($Iki, ENT_QUOTES);
	$Sonuc	=	$Uc;
	return $Sonuc;
}

$IPAdresi			=	$_SERVER["REMOTE_ADDR"];
$ZamanDamgasi		=	time();
$OyKullanmaSiniri	=	1; // Saniye Cinsinden
$ZamaniGeriAl		=	$ZamanDamgasi-$OyKullanmaSiniri;

?>
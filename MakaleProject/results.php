<?php
require_once("connection.php");
?>
<!doctype html>
<html lang="tr-TR">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="tr">
<meta charset="utf-8">
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
<body>

	<?php
	$AnketSorgusu	=	$pdo->prepare("SELECT * FROM anket LIMIT 1");
	$AnketSorgusu->execute();
	$KayitSayisi	=	$AnketSorgusu->rowCount();
	$Kayit			=	$AnketSorgusu->fetch(PDO::FETCH_ASSOC);
	
	$AnketinBirinciSikkiIcinOySayisi	=	$Kayit["oybir"];
	$AnketinIkinciSikkiIcinOySayisi		=	$Kayit["oyiki"];
	$AnketinUcuncuSikkiIcinOySayisi		=	$Kayit["oyüc"];
	$AnketinToplamOySayisi				=	$Kayit["toplamoysayisi"];
	
	$BirinciSecenekIcinYuzdeHesapla		=	($AnketinBirinciSikkiIcinOySayisi/$AnketinToplamOySayisi)*100;
	$BirinciSecenekIcinYuzde			=	number_format($BirinciSecenekIcinYuzdeHesapla, 2, ",", "");
	$IkinciSecenekIcinYuzdeHesapla		=	($AnketinIkinciSikkiIcinOySayisi/$AnketinToplamOySayisi)*100;
	$IkinciSecenekIcinYuzde				=	number_format($IkinciSecenekIcinYuzdeHesapla, 2, ",", "");
	$UcuncuSecenekIcinYuzdeHesapla		=	($AnketinUcuncuSikkiIcinOySayisi/$AnketinToplamOySayisi)*100;
	$UcuncuSecenekIcinYuzde				=	number_format($UcuncuSecenekIcinYuzdeHesapla, 2, ",", "");
	
	if($KayitSayisi>0){
	?>

<table width="300" align="center" border="0" cellpadding="0" cellspacing="0" style="color: white;font-size: 42px;">
	<tr height="30">
		<td colspan="2"><?php echo $Kayit["soru"]; ?></td>
	</tr>
		
	<tr>
        <td colspan="5" height="20">&nbsp;</td>
    </tr>

	<tr height="30">
		<td width="75">%<?php echo $BirinciSecenekIcinYuzde; ?></td>
		<td width="225"><?php echo $Kayit["cevapbir"]; ?></td>
	</tr>
		
	<tr>
        <td colspan="5" height="20">&nbsp;</td>
    </tr>

	<tr height="30">
	    <td width="75">%<?php echo $IkinciSecenekIcinYuzde; ?></td>
		<td width="225"><?php echo $Kayit["cevapiki"]; ?></td>
	</tr>
		
	<tr>
        <td colspan="5" height="20">&nbsp;</td>
    </tr>

	<tr height="30">
		<td width="75">%<?php echo $UcuncuSecenekIcinYuzde; ?></td>
		<td width="225"><?php echo $Kayit["cevapüc"]; ?></td>
	</tr>
		
	<tr>
        <td colspan="5" height="20">&nbsp;</td>
    </tr>
		
	<tr height="30">
		<td colspan="2" align="right"><a href="HomePage.php" style="color: white;">Ana Sayfaya Dön</a></td>
	</tr>

	<?php
	}else{
		header("Location:HomePage.php");
		exit();
	}
	?>

</body>
</html>

<?php
$pdo	=	null;
?>
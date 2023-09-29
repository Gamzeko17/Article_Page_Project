<?php
require_once("connection.php");
?>

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
<body style="opacity:0.92">

    <?php
    $ReklamSorgusu = $pdo->prepare("SELECT * FROM banner ORDER BY gosterimsayisi ASC LIMIT 1");
    $ReklamSorgusu->execute();
    $ReklamSayisi = $ReklamSorgusu->rowCount();
    $ReklamKaydi = $ReklamSorgusu->fetch(PDO::FETCH_ASSOC);
    ?>

<table width="1800" height="900" align="center" border="0" cellpadding="0" cellspacing="0">
<H3 style="text-align: center;font-size: 36px;color:white;font-family: cursive;font-style: italic;">&nbsp;KÜRESEL ISINMA BLOG PROJECT</H3>
    <tr>
        <td colspan="5" height="100" style="background-color:#white">
            <table width="1000" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="150">
                    <td align="center">
                        <img src="image/<?php echo $ReklamKaydi["bannerdosyasi"]; ?>" border="0" style="height: 600px;width: 1418px;">
                    </td>
                </tr>
            </table>         
        </td>
    </tr>
        
    <tr>
        <td colspan="5" height="20">&nbsp;</td>
    </tr>
</table>


<table width="1800" height="900" align="center" border="0" cellpadding="0" cellspacing="0" style="" >
    <tr>
        <td colspan="6" width="580" height="400" style="">
            <div style="display: flex; margin-left: auto; margin-right: auto;background-color:#CCCCCC;height:849px">

            <?php
                $sqlMakaleler = "SELECT * FROM makale";
                $makalelerQuery = $pdo->prepare($sqlMakaleler);
                $makalelerQuery->execute();
                $makaleler = $makalelerQuery->fetchAll();
                
            foreach ($makaleler as $makale)
            {
            ?>

            <div style="width:432px; height: auto; border: 1px solid #E9E9E9; margin-left: 15px;">

                <div>
                    <img style="width: 378px;height: 424px;margin-left: 29px;margin-right: auto;" src="<?php echo $makale["image"]; ?>" alt="">
                </div>

                <div style="text-align: center; border-bottom: 1px dashed #E9E9E9">
                    <h4 style="padding: 5px; margin: 0;font-size:24px"><?php echo $makale["title"]; ?></h4>
                </div>

                <div style="text-align: center">
                    <p style="font-size:22px"><?php echo $makale["description"]; ?></p>
                </div>

                <div style="text-align: right">
                    <button style="border-radius:31px"><a style="font-size: 22px;margin-right: 19px;text-align: center;text-decoration: none;margin-left: 23px;color: darkcyan;" class="btn btn-primary" href="detail.php?id=<?php echo $makale["id"]; ?>" role="button">İncele</a></button>
                </div>

            </div>

            <?php
            }
            ?>

        </td>
    </tr>
</table>


    <?php
	$AnketSorgusu	=	$pdo->prepare("SELECT * FROM anket LIMIT 1");
	$AnketSorgusu->execute();
	$KayitSayisi	=	$AnketSorgusu->rowCount();
	$Kayit			=	$AnketSorgusu->fetch(PDO::FETCH_ASSOC);
	
	if($KayitSayisi>0){
	?>

<form action="vote.php" method="post">
    <table width="1800" height="300" align="center" border="0" cellpadding="0" cellspacing="0" style="background-color:#CCCCCC;height: 314px;margin-top: 115px;">
            <tr height="30">
				<td colspan="2" style="font-size: 30px;text-align: center;font-weight: bolder;"><p><?php echo $Kayit["soru"]; ?></p></td>
			</tr>

			<tr height="30">
				<td width="30"><input type="radio" name="cevap" value="1" style="width: 165px;height: 16px;list-style-position:inside"></td>
				<td width="1770" style="font-size: 22px;"><p style="margin-left: -52px;"><?php echo $Kayit["cevapbir"]; ?></p></td>
			</tr>

			<tr height="30">
				<td width="30"><input type="radio" name="cevap" value="2" style="width: 165px;height: 16px;"></td>
				<td width="1770" style="font-size: 22px;"><p style="margin-left: -52px;"><?php echo $Kayit["cevapiki"]; ?></p></td>
			</tr>

			<tr height="30">
				<td width="30"><input type="radio" name="cevap" value="3" style="width: 165px;height: 16px;"></td>
				<td width="1770" style="font-size: 22px;"><p style="margin-left: -52px;"><?php echo $Kayit["cevapüc"]; ?></p></td>
			</tr>

			<tr height="30">
				<td colspan="2"><input type="submit" value="Oyumu Gönder" style="width: 206px;height: 49px;border-radius: 73px;margin-left: 1620px;margin-right:25px;text-align: center;font-size:20px;color:darkblue;margin-top: -45px;"></td>
			</tr

			<tr height="30">
				<td colspan="2" align="right"><p style="margin-bottom:75px"><a href="results.php" style="color: blue; text-decoration: none;margin-right: 40px;font-size:20px;">Anket Sonuçlarını Göster</a></p></td>
		    </tr>
    </table>
</form>

	<?php
	}else{
	?>
	Anket Bulunmuyor.
	<?php
	}
	?>

</body>
</html>

<?php
$ReklamGuncelle = $pdo->prepare("UPDATE banner SET gosterimsayisi=gosterimsayisi+1 WHERE id = ? LIMIT 1");
$ReklamGuncelle->execute([$ReklamKaydi["id"]]);
$pdo = null;
?>


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
<body style="color:white;font-size:42px">
    
    <?php

    $makaleId = $_GET["id"];

    if($makaleId==2){
        header("Location:https://www.sozcu.com.tr/2021/teknoloji/kuresel-isinma-ile-ilgili-dikkat-ceken-bilimsel-arastirma-6716411/");
        exit();
    }elseif($makaleId==3){
        header("Location:https://www.bbc.com/turkce/haberler-51144765");
        exit();
    }elseif($makaleId==4){
        header("Location:https://evrimagaci.org/iklim-degisikligi-ve-kuresel-isinma-insanlar-da-dahil-tum-hayvanlarin-beyin-ve-sinir-sistemini-nasil-etkiliyor-9343");
        exit();
    }elseif($makaleId==5){
        header("Location:https://www.dogrulukpayi.com/dogruluk-kontrolu/kuresel-isinmanin-gercek-olmadigi-iddiasi");
        exit();
    }
    ?>

</body>
</html>
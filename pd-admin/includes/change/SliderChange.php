<?php
    function sliderChange($pdo) {
        $id = $_GET['sliderChange'];
        $slider_name = $_POST['slider_name'];
        $slider_info = $_POST['slider_info'];
        $en_slider_name = $_POST['en_slider_name'];
        $en_slider_info = $_POST['en_slider_info'];
        $de_slider_name = $_POST['de_slider_name'];
        $de_slider_info = $_POST['de_slider_info'];
        $ru_slider_name = $_POST['ru_slider_name'];
        $ru_slider_info = $_POST['ru_slider_info'];
        $bg_slider_name = $_POST['bg_slider_name'];
        $bg_slider_info = $_POST['bg_slider_info'];
        $ar_slider_name = $_POST['ar_slider_name'];
        $ar_slider_info = $_POST['ar_slider_info'];
        $slider_picture = $_POST['slider_picture'];
        $slider_user = $_POST['slider_user'];
        $slider_date = date("d.m.Y");

        $imageName = $_FILES["slider_picture"]["name"];
        $imageSize = $_FILES["slider_picture"]["size"];
        $imageType = $_FILES["slider_picture"]["type"];
        $imageUrl = $_FILES["slider_picture"]["tmp_name"];
        $imageHref = "pic/";
        $imageRound = rand(1,10000);

        $resim_degis = $_POST['resim_degis'];

        try {
            if($resim_degis == 0) {
                $sliderSQL = $pdo->prepare("UPDATE slider SET
                slider_name = '$slider_name', slider_info = '$slider_info',
                en_slider_name = '$en_slider_name', en_slider_info = '$en_slider_info',
                de_slider_name = '$de_slider_name', de_slider_info = '$de_slider_info',
                ru_slider_name = '$ru_slider_name', ru_slider_info = '$ru_slider_info',
                bg_slider_name = '$bg_slider_name', bg_slider_info = '$bg_slider_info',
                ar_slider_name = '$ar_slider_name', ar_slider_info = '$ar_slider_info',
                slider_user = '$slider_user', slider_date = '$slider_date'
                WHERE id = '$id'");
                $sliderSQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Slider</b> başarıyla değiştirildi.</div>';
                header("Refresh:2; url=slider-change.php");
            } elseif($resim_degis == 1) {
                if($imageUrl == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Slider Resmi</b> seçiniz !</div>";
                    header("Refresh:2; url=slider-changed.php?sliderChange=$id");
                } elseif($imageSize > 50000000) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                    header('Refresh:2; url=slider-changed.php?sliderChange=$id');
                } elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                    header('Refresh:2; url=slider-changed.php?sliderChange=$id');
                } else {
                    $imageUpload = move_uploaded_file($imageUrl, $imageHref."/".$imageRound."-".$imageName);
                    $NewPicture = $imageRound."-".$imageName;
                    $sliderSQL = $pdo->prepare("UPDATE slider SET
                    slider_name = '$slider_name', slider_info = '$slider_info',
                    en_slider_name = '$en_slider_name', en_slider_info = '$en_slider_info',
                    de_slider_name = '$de_slider_name', de_slider_info = '$de_slider_info',
                    ru_slider_name = '$ru_slider_name', ru_slider_info = '$ru_slider_info',
                    bg_slider_name = '$bg_slider_name', bg_slider_info = '$bg_slider_info',
                    ar_slider_name = '$ar_slider_name', ar_slider_info = '$ar_slider_info',
                    slider_picture = '$NewPicture', slider_user = '$slider_user', slider_date = '$slider_date'
                    WHERE id = '$id'");
                    $sliderSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Slider</b> başarıyla değiştirildi.</div>';
                    header("Refresh:2; url=slider-change.php");
                }
            }

        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
                Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
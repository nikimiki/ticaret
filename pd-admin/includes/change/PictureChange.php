<?php
    function ProfilPictureChange($pdo)
    {
        @$picture = $_POST['picture'];
        $id = $_GET['userView'];

        $imageName = $_FILES['picture']['name'];
        @$imageSize = $_FILES['pciture']['size'];
        $imageType = $_FILES['picture']['type'];
        $imageUrl = $_FILES['picture']['tmp_name'];
        $imageHref = 'pic/';
        $imageRound = rand(1, 10000);

        try {
            if (isset($imageUrl)) {
                if ($imageSize > 50000000) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                    header("Refresh:2; url=profil-picture.php?userView=$id");
                } elseif (($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                    header("Refresh:2; url=profil-picture.php?userView=$id");
                } else {
                    $imageUpload = move_uploaded_file($imageUrl, $imageHref . '/' . $imageRound . '-' . $imageName);
                    $NewPicture = $imageRound . '-' . $imageName;
                    $pictureSQL = $pdo->prepare("UPDATE users SET picture = '$NewPicture' WHERE id = '$id'");
                    $pictureSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Profil Resmi</b> başarıyla değiştirildi !</div>';
                    header("Refresh:2; url=profil.php?userView=$id");
                }
            } else {
                echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, <b>Profil Resmi</b> seçiniz !</div>';
                header("Refresh:2; url=profil-picture.php?userView=$id");
            }
        } catch (PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
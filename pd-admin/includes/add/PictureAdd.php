<?php
    function pictureAdd($pdo) {
        $article_id = $_POST['article_id'];
        $category_id = $_POST['category_id'];
        $subcategory_id = $_POST['subcategory_id'];
        $picture_info = $_POST['picture_info'];
        $en_picture_info = $_POST['en_picture_info'];
        $de_picture_info = $_POST['de_picture_info'];
        $ru_picture_info = $_POST['ru_picture_info'];
        $bg_picture_info = $_POST['bg_picture_info'];
        $ar_picture_info = $_POST['ar_picture_info'];
        $picture = $_POST['picture'];
        $picture_user = $_POST['picture_user'];
        $picture_date = date("d.m.Y");
        $eklenecek_yer = $_POST['eklenecek_yer'];

        $picture_name = $_FILES["picture"]["name"];
        $en_picture_name = $_FILES["picture"]["name"];
        $de_picture_name = $_FILES["picture"]["name"];
        $ru_picture_name = $_FILES["picture"]["name"];
        $bg_picture_name = $_FILES["picture"]["name"];
        $ar_picture_name = $_FILES["picture"]["name"];
        $imageSize = $_FILES["picture"]["size"];
        $imageType = $_FILES["picture"]["type"];
        $imageUrl = $_FILES["picture"]["tmp_name"];
        $imageHref = "pic/";
        $imageRound = rand(1,10000);


        try {
            // Eklenecek Yer Yazılar
            if($eklenecek_yer == 0) {
                if($picture_name == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim Adını</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif($picture_info == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim İçeriğini</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif(empty($imageUrl)) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim</b> seçiniz !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif($imageSize > 50000000) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                else {
                    $imageUpload = move_uploaded_file($imageUrl, $imageHref."/".$imageRound."-".$picture_name);
                    $Newpicture = $imageRound."-".$picture_name;
                    $pics_name = $_POST['picture_name'];
                    $en_pics_name = $_POST['en_picture_name'];
                    $de_pics_name = $_POST['de_picture_name'];
                    $ru_pics_name = $_POST['ru_picture_name'];
                    $bg_pics_name = $_POST['bg_picture_name'];
                    $ar_pics_name = $_POST['ar_picture_name'];
                    $pictureSQL = $pdo->prepare("
                    INSERT INTO picture (article_id, category_id, subcategory_id, picture_name, picture_info,
                    en_picture_name, en_picture_info, de_picture_name, de_picture_info, ru_picture_name, ru_picture_info,
                    bg_picture_name, bg_picture_info, ar_picture_name, ar_picture_info,
                    picture, picture_user, picture_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $pictureSQL->execute(array($article_id, 0, 0, $pics_name, $picture_info,
                    $en_pics_name, $en_picture_info, $de_pics_name, $de_picture_info, $ru_pics_name, $ru_picture_info,
                    $bg_pics_name, $bg_picture_info, $ar_pics_name, $ar_picture_info,
                        $Newpicture, $picture_user, $picture_date));

                    header('Refresh:2, url=pictures.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Resim</b> başarıyla eklenmiştir.</div>";
                }
            }
            // Eklenecek Yer Kategori
            if($eklenecek_yer == 1) {
                if($picture_name == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim Adını</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif($picture_info == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim İçeriğini</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif(empty($imageUrl)) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim</b> seçiniz !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif($imageSize > 50000000) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                else {
                    $imageUpload = move_uploaded_file($imageUrl, $imageHref."/".$imageRound."-".$picture_name);
                    $Newpicture = $imageRound."-".$picture_name;
                    $pics_name = $_POST['picture_name'];
                    $en_pics_name = $_POST['en_picture_name'];
                    $de_pics_name = $_POST['de_picture_name'];
                    $ru_pics_name = $_POST['ru_picture_name'];
                    $bg_pics_name = $_POST['bg_picture_name'];
                    $ar_pics_name = $_POST['ar_picture_name'];
                    $pictureSQL = $pdo->prepare("
                    INSERT INTO picture (article_id, category_id, subcategory_id, picture_name, picture_info,
                    en_picture_name, en_picture_info, de_picture_name, de_picture_info, ru_picture_name, ru_picture_info,
                    bg_picture_name, bg_picture_info, ar_picture_name, ar_picture_info,
                    picture, picture_user, picture_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $pictureSQL->execute(array(0, $category_id, 0, $pics_name, $picture_info,
                        $en_pics_name, $en_picture_info, $de_pics_name, $de_picture_info, $ru_pics_name, $ru_picture_info,
                        $bg_pics_name, $bg_picture_info, $ar_pics_name, $ar_picture_info,
                        $Newpicture, $picture_user, $picture_date));

                    header('Refresh:2, url=pictures.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Resim</b> başarıyla eklenmiştir.</div>";
                }
            }
            // Eklenecek Yer Alt Kategori
            if($eklenecek_yer == 2) {
                if($picture_name == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim Adını</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif($picture_info == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim İçeriğini</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif(empty($imageUrl)) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim</b> seçiniz !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif($imageSize > 50000000) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                else {
                    $imageUpload = move_uploaded_file($imageUrl, $imageHref."/".$imageRound."-".$picture_name);
                    $Newpicture = $imageRound."-".$picture_name;
                    $pics_name = $_POST['picture_name'];
                    $en_pics_name = $_POST['en_picture_name'];
                    $de_pics_name = $_POST['de_picture_name'];
                    $ru_pics_name = $_POST['ru_picture_name'];
                    $bg_pics_name = $_POST['bg_picture_name'];
                    $ar_pics_name = $_POST['ar_picture_name'];
                    $pictureSQL = $pdo->prepare("
                    INSERT INTO picture (article_id, category_id, subcategory_id, picture_name, picture_info,
                    en_picture_name, en_picture_info, de_picture_name, de_picture_info, ru_picture_name, ru_picture_info,
                    bg_picture_name, bg_picture_info, ar_picture_name, ar_picture_info,
                    picture, picture_user, picture_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $pictureSQL->execute(array(0, 0, $subcategory_id, $pics_name, $picture_info,
                        $en_pics_name, $en_picture_info, $de_pics_name, $de_picture_info, $ru_pics_name, $ru_picture_info,
                        $bg_pics_name, $bg_picture_info, $ar_pics_name, $ar_picture_info,
                        $Newpicture, $picture_user, $picture_date));

                    header('Refresh:2, url=pictures.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Resim</b> başarıyla eklenmiştir.</div>";
                }
            }
            // Eklenecek Yer Resimler
            if($eklenecek_yer == 3) {
                if($picture_name == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim Adını</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif($picture_info == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim İçeriğini</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif(empty($imageUrl)) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Resim</b> seçiniz !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif($imageSize > 50000000) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                    header('Refresh:2; url=picture-add.php');
                }
                else {
                    $imageUpload = move_uploaded_file($imageUrl, $imageHref."/".$imageRound."-".$picture_name);
                    $Newpicture = $imageRound."-".$picture_name;
                    $pics_name = $_POST['picture_name'];
                    $en_pics_name = $_POST['en_picture_name'];
                    $de_pics_name = $_POST['de_picture_name'];
                    $ru_pics_name = $_POST['ru_picture_name'];
                    $bg_pics_name = $_POST['bg_picture_name'];
                    $ar_pics_name = $_POST['ar_picture_name'];
                    $pictureSQL = $pdo->prepare("
                    INSERT INTO picture (article_id, category_id, subcategory_id, picture_name, picture_info,
                    en_picture_name, en_picture_info, de_picture_name, de_picture_info, ru_picture_name, ru_picture_info,
                    bg_picture_name, bg_picture_info, ar_picture_name, ar_picture_info,
                    picture, picture_user, picture_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $pictureSQL->execute(array(0, 0, 0, $pics_name, $picture_info,
                        $en_pics_name, $en_picture_info, $de_pics_name, $de_picture_info, $ru_pics_name, $ru_picture_info,
                        $bg_pics_name, $bg_picture_info, $ar_pics_name, $ar_picture_info,
                        $Newpicture, $picture_user, $picture_date));

                    header('Refresh:2, url=pictures.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Resim</b> başarıyla eklenmiştir.</div>";
                }
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
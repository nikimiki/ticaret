<?php
    function articleAdd($pdo) {
        $category_id = $_POST['category_id'];
        $page_id = $_POST['page_id'];
        $subpage_id = $_POST['subpage_id'];
        $subcategory_id = $_POST['subcategory_id'];
        $article_name = $_POST['article_name'];
        $article_info = $_POST['article_info'];
        $en_article_name = $_POST['en_article_name'];
        $en_article_info = $_POST['en_article_info'];
        $de_article_name = $_POST['de_article_name'];
        $de_article_info = $_POST['de_article_info'];
        $ru_article_name = $_POST['ru_article_name'];
        $ru_article_info = $_POST['ru_article_info'];
        $bg_article_name = $_POST['bg_article_name'];
        $bg_article_info = $_POST['bg_article_info'];
        $ar_article_name = $_POST['ar_article_name'];
        $ar_article_info = $_POST['ar_article_info'];
        $article_link = $_POST['article_link'];
        $article_picture = $_POST['article_picture'];
        $article_user = $_POST['article_user'];
        $article_date = date("d.m.Y");

        $eklenecek_yer = $_POST['eklenecek_yer'];

        $imageName = $_FILES["article_picture"]["name"];
        $imageSize = $_FILES["article_picture"]["size"];
        $imageType = $_FILES["article_picture"]["type"];
        $imageUrl = $_FILES["article_picture"]["tmp_name"];
        $imageHref = "pic/";
        $imageRound = rand(1,10000);

        try {
            //eklenecek Yer Sayfa
            if($eklenecek_yer == 0) {
                if($article_name == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı Başlığını</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif($article_info == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı İçeriğini</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif(empty($imageUrl)) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı Resmi</b> seçiniz !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif($imageSize > 50000000) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                else {
                    $imageUpload = move_uploaded_file($imageUrl, $imageHref."/".$imageRound."-".$imageName);
                    $NewPicture = $imageRound."-".$imageName;
                    $articleSQL = $pdo->prepare("
                INSERT INTO article (page_id, subpage_id, category_id, subcategory_id,
                article_name, article_info, en_article_name, en_article_info, de_article_name, de_article_info,
                ru_article_name, ru_article_info, bg_article_name, bg_article_info, ar_article_name, ar_article_info,
                article_link, article_picture, article_user, article_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $articleSQL->execute(array($page_id, 0, 0, 0,
                        $article_name, $article_info, $en_article_name, $en_article_info, $de_article_name, $de_article_info,
                        $ru_article_name, $ru_article_info, $bg_article_name, $bg_article_info, $ar_article_name, $ar_article_info,
                        $article_link, $NewPicture, $article_user, $article_date));

                    header('Refresh:2, url=articles.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Yazı</b> başarıyla eklenmiştir.</div>";
                }
            }
            //eklenecek Yer Kategori
            elseif($eklenecek_yer == 1) {
                if($article_name == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı Başlığını</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif($article_info == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı İçeriğini</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif(empty($imageUrl)) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı Resmi</b> seçiniz !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif($imageSize > 50000000) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                else {
                    $imageUpload = move_uploaded_file($imageUrl, $imageHref."/".$imageRound."-".$imageName);
                    $NewPicture = $imageRound."-".$imageName;
                    $articleSQL = $pdo->prepare("
                INSERT INTO article (category_id, page_id, subpage_id, subcategory_id,
                article_name, article_info, en_article_name, en_article_info, de_article_name, de_article_info,
                ru_article_name, ru_article_info, bg_article_name, bg_article_info, ar_article_name, ar_article_info,
                article_link, article_picture, article_user, article_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $articleSQL->execute(array($category_id, 0, 0, 0,
                        $article_name, $article_info, $en_article_name, $en_article_info, $de_article_name, $de_article_info,
                        $ru_article_name, $ru_article_info, $bg_article_name, $bg_article_info, $ar_article_name, $ar_article_info,
                        $article_link, $NewPicture, $article_user, $article_date));

                    header('Refresh:2, url=articles.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Yazı</b> başarıyla eklenmiştir.</div>";
                }
            }
            //eklenecek Yer Alt Kategori
            elseif($eklenecek_yer == 2) {
                if($article_name == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı Başlığını</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif($article_info == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı İçeriğini</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif(empty($imageUrl)) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı Resmi</b> seçiniz !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif($imageSize > 50000000) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                else {
                    $imageUpload = move_uploaded_file($imageUrl, $imageHref."/".$imageRound."-".$imageName);
                    $NewPicture = $imageRound."-".$imageName;
                    $articleSQL = $pdo->prepare("
                INSERT INTO article (subcategory_id, page_id, subpage_id, category_id,
                article_name, article_info, en_article_name, en_article_info, de_article_name, de_article_info,
                ru_article_name, ru_article_info, bg_article_name, bg_article_info, ar_article_name, ar_article_info,
                article_link, article_picture, article_user, article_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $articleSQL->execute(array($subcategory_id, 0, 0, 0,
                        $article_name, $article_info, $en_article_name, $en_article_info, $de_article_name, $de_article_info,
                        $ru_article_name, $ru_article_info, $bg_article_name, $bg_article_info, $ar_article_name, $ar_article_info,
                        $article_link, $NewPicture, $article_user, $article_date));

                    header('Refresh:2, url=articles.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Yazı</b> başarıyla eklenmiştir.</div>";
                }
            }
            //eklenecek Yer Alt Sayfa
            elseif($eklenecek_yer == 3) {
                if($article_name == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı Başlığını</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif($article_info == '') {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı İçeriğini</b> boş bırakmayınız !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif(empty($imageUrl)) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Yazı Resmi</b> seçiniz !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif($imageSize > 50000000) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                    header('Refresh:2; url=article-add.php');
                }
                else {
                    $imageUpload = move_uploaded_file($imageUrl, $imageHref."/".$imageRound."-".$imageName);
                    $NewPicture = $imageRound."-".$imageName;
                    $articleSQL = $pdo->prepare("
                INSERT INTO article (subpage_id, page_id, category_id, subcategory_id,
                article_name, article_info, en_article_name, en_article_info, de_article_name, de_article_info,
                ru_article_name, ru_article_info, bg_article_name, bg_article_info, ar_article_name, ar_article_info,
                article_link, article_picture, article_user, article_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $articleSQL->execute(array($subpage_id, 0, 0, 0,
                        $article_name, $article_info, $en_article_name, $en_article_info, $de_article_name, $de_article_info,
                        $ru_article_name, $ru_article_info, $bg_article_name, $bg_article_info, $ar_article_name, $ar_article_info,
                        $article_link, $NewPicture, $article_user, $article_date));

                    header('Refresh:2, url=articles.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Yazı</b> başarıyla eklenmiştir.</div>";
                }
            }

        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
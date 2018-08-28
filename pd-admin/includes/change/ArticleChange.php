<?php
    function articleChange($pdo) {
        $id = $_GET['articleChange'];
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
        $article_date = date('d.m.Y');
        $page_degis = $_POST['page_degis'];
        $image_degis = $_POST['image_degis'];

        $imageName = $_FILES['article_picture']['name'];
        $imageSize = $_FILES['article_picture']['size'];
        $imageType = $_FILES['article_picture']['type'];
        $imageUrl = $_FILES['article_picture']['tmp_name'];
        $imageHref = "pic/";
        $imageRound = rand(1,10000);

        try {
            // Yer değiştirilmedi
            if($page_degis == 0) {
                // Yer değiştirilmedi ve Resim değiştirilecek
                if($image_degis == 1) {
                    // Resimde veri var
                    if(isset($imageUrl)) {
                        if($imageSize > 50000000) {
                            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                            header("Refresh:2; url=article-changed.php?articleChange=$id");
                        }
                        elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                            header("Refresh:2; url=article-changed.php?articleChange=$id");
                        } else {
                            $imageUpload = move_uploaded_file($imageUrl, $imageHref.'/'.$imageRound.'-'.$imageName);
                            $NewPicture = $imageRound.'-'.$imageName;
                            $articleSQL = $pdo->prepare("
                            UPDATE article SET
                            article_name = '$article_name', article_info = '$article_info',
                            en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                            de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                            ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                            bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                            ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                            article_link = '$article_link', article_picture = '$NewPicture',
                            article_user = '$article_user', article_date = '$article_date'
                            WHERE id = '$id'");
                            $articleSQL->execute();
                            echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                            Değiştirilenler: <br/>
                            <i class="fa fa-check" style="font-size: 15px;"></i> Yazı Resim<br/>
                            </div>';
                            header("Refresh:2; url=article-change.php");
                        }
                    }
                    // Resimde veri yok
                    else {
                        $articleSQL = $pdo->prepare("
                        UPDATE article SET
                        article_name = '$article_name', article_info = '$article_info',
                        en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                        de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                        ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                        bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                        ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                        article_link = '$article_link', article_user = '$article_user', article_date = '$article_date'
                        WHERE id = '$id'");
                        $articleSQL->execute();
                        echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                        Değişmeyenler: <br/>
                        <i class="fa fa-ban" style="font-size: 15px;"></i> Eklenecek Yer ve Yazı Resimi<br/>
                        </div>';
                        header("Refresh:2; url=article-change.php");
                    }
                }
                // Yer değiştirilmedi ve Resim değiştirilmedi
                else {
                    $articleSQL = $pdo->prepare("
                    UPDATE article SET
                    article_name = '$article_name', article_info = '$article_info',
                    en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                    de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                    ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                    bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                    ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                    article_link = '$article_link', article_user = '$article_user', article_date = '$article_date'
                    WHERE id = '$id'");
                    $articleSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi.<br/><br/>
                    Değişmeyenler: <br/>
                    <i class="fa fa-ban" style="font-size: 15px;"></i> Eklenecek Yer ve Yazı Resimi<br/>
                    </div>';
                    header("Refresh:2; url=article-change.php");
                }
            }
            // Yer değistirilecek ve Page seçili
            elseif($page_degis == 1) {
                // Yer Page olarak değiştiriliyor ve Resim de değişecek
                if($image_degis == 1) {
                    // Resimde veri var
                    if(isset($imageUrl)) {
                        if($imageSize > 50000000) {
                            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                            header("Refresh:2; url=article-changed.php?articleChange=$id");
                        }
                        elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                            header("Refresh:2; url=article-changed.php?articleChange=$id");
                        } else {
                            $imageUpload = move_uploaded_file($imageUrl, $imageHref.'/'.$imageRound.'-'.$imageName);
                            $NewPicture = $imageRound.'-'.$imageName;
                            $articleSQL = $pdo->prepare("
                            UPDATE article SET
                            page_id = '$page_id', category_id = 0, subcategory_id = 0, article_name = '$article_name', article_info = '$article_info',
                            en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                            de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                            ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                            bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                            ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                            article_link = '$article_link', article_picture = '$NewPicture',
                            article_user = '$article_user', article_date = '$article_date'
                            WHERE id = '$id'");
                            $articleSQL->execute();
                            echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                            Değiştirilenler: <br/>
                            <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer: Sayfa ve Yazı Resim<br/>
                            </div>';
                            header("Refresh:2; url=article-change.php");
                        }
                    }
                    // Resimde veri yok
                    else {
                        $articleSQL = $pdo->prepare("
                        UPDATE article SET
                        page_id = '$page_id', category_id = 0, subcategory_id = 0, article_name = '$article_name', article_info = '$article_info',
                        en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                        de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                        ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                        bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                        ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                        article_link = '$article_link', article_user = '$article_user', article_date = '$article_date'
                        WHERE id = '$id'");
                        $articleSQL->execute();
                        echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                        Değiştirilenler: <br/>
                        <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer: Sayfa<br/>
                        </div>';
                        header("Refresh:2; url=article-change.php");
                    }
                }
                // Yer Page olarak değiştiriliyor ve Resim değişmeyecek
                else {
                    $articleSQL = $pdo->prepare("
                    UPDATE article SET
                    page_id = '$page_id', category_id = 0, subcategory_id = 0, article_name = '$article_name', article_info = '$article_info',
                    en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                    de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                    ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                    bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                    ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                    article_link = '$article_link', article_user = '$article_user', article_date = '$article_date'
                    WHERE id = '$id'");
                    $articleSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                    Değişmeyenler: <br/>
                    <i class="fa fa-ban" style="font-size: 15px;"></i> Yazı Resimi<br/>
                    </div>';
                    header("Refresh:2; url=article-change.php");
                }
            }
            // Yer değiştirelecek ve Category seçili
            elseif($page_degis == 2) {
                // Yer Category olarak değiştiriliyor ve Resim de değişecek
                if($image_degis == 1) {
                    // Resimde veri var
                    if(isset($imageUrl)) {
                        if($imageSize > 50000000) {
                            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                            header("Refresh:2; url=article-changed.php?articleChange=$id");
                        }
                        elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                            header("Refresh:2; url=article-changed.php?articleChange=$id");
                        } else {
                            $imageUpload = move_uploaded_file($imageUrl, $imageHref.'/'.$imageRound.'-'.$imageName);
                            $NewPicture = $imageRound.'-'.$imageName;
                            $articleSQL = $pdo->prepare("
                            UPDATE article SET
                            page_id = 0, category_id = '$category_id', subcategory_id = 0, article_name = '$article_name', article_info = '$article_info',
                            en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                            de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                            ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                            bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                            ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                            article_link = '$article_link', article_picture = '$NewPicture',
                            article_user = '$article_user', article_date = '$article_date'
                            WHERE id = '$id'");
                            $articleSQL->execute();
                            echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                            Değiştirilenler: <br/>
                            <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer: Kategori ve Yazı Resim<br/>
                            </div>';
                            header("Refresh:2; url=article-change.php");
                        }
                    }
                    // Resimde veri yok
                    else {
                        $articleSQL = $pdo->prepare("
                        UPDATE article SET
                        page_id = 0, category_id = '$category_id', subcategory_id = 0, article_name = '$article_name', article_info = '$article_info',
                        en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                        de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                        ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                        bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                        ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                        article_link = '$article_link', article_user = '$article_user', article_date = '$article_date'
                        WHERE id = '$id'");
                        $articleSQL->execute();
                        echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                        Değiştirilenler: <br/>
                        <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer: Kategori<br/>
                        </div>';
                        header("Refresh:2; url=article-change.php");
                    }
                }
                // Yer Category olarak değiştiriliyor ve Resim değişmeyecek
                else {
                    $articleSQL = $pdo->prepare("
                    UPDATE article SET
                    page_id = 0, category_id = '$category_id', subcategory_id = 0, article_name = '$article_name', article_info = '$article_info',
                    en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                    de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                    ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                    bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                    ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                    article_link = '$article_link', article_user = '$article_user', article_date = '$article_date'
                    WHERE id = '$id'");
                    $articleSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                    Değişmeyenler: <br/>
                    <i class="fa fa-ban" style="font-size: 15px;"></i> Yazı Resimi<br/>
                    </div>';
                    header("Refresh:2; url=article-change.php");
                }
            }
            // Yer değiştirelecek ve Sub Category seçili
            elseif($page_degis == 3) {
                // Yer Sub Category olarak değiştiriliyor ve Resim de değişecek
                if($image_degis == 1) {
                    // Resimde veri vr
                    if(isset($imageUrl)) {
                        if($imageSize > 50000000) {
                            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                            header("Refresh:2; url=article-changed.php?articleChange=$id");
                        }
                        elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                            header("Refresh:2; url=article-changed.php?articleChange=$id");
                        } else {
                            $imageUpload = move_uploaded_file($imageUrl, $imageHref.'/'.$imageRound.'-'.$imageName);
                            $NewPicture = $imageRound.'-'.$imageName;
                            $articleSQL = $pdo->prepare("
                            UPDATE article SET
                            page_id = 0, category_id = 0, subcategory_id = '$subcategory_id', article_name = '$article_name', article_info = '$article_info',
                            en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                            de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                            ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                            bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                            ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                            article_link = '$article_link', article_picture = '$NewPicture',
                            article_user = '$article_user', article_date = '$article_date'
                            WHERE id = '$id'");
                            $articleSQL->execute();
                            echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                            Değiştirilenler: <br/>
                            <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer: Alt Kategori ve Yazı Resim<br/>
                            </div>';
                            header("Refresh:2; url=article-change.php");
                        }
                    }
                    // Resimde veri yok
                    else {
                        $articleSQL = $pdo->prepare("
                        UPDATE article SET
                        page_id = 0, category_id = 0, subcategory_id = '$subcategory_id', article_name = '$article_name', article_info = '$article_info',
                        en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                        de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                        ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                        bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                        ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                        article_link = '$article_link', article_user = '$article_user', article_date = '$article_date'
                        WHERE id = '$id'");
                        $articleSQL->execute();
                        echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                        Değiştirilenler: <br/>
                        <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer: Alt Kategori<br/>
                        </div>';
                        header("Refresh:2; url=article-change.php");
                    }
                }
                // Yer Sub Category olarak değiştiriliyor ve Resim değişmeyecek
                else {
                    $articleSQL = $pdo->prepare("
                    UPDATE article SET
                    page_id = 0, category_id = 0, subcategory_id = '$subcategory_id', article_name = '$article_name', article_info = '$article_info',
                    en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                    de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                    ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                    bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                    ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                    article_link = '$article_link', article_user = '$article_user', article_date = '$article_date'
                    WHERE id = '$id'");
                    $articleSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                    Değişmeyenler: <br/>
                    <i class="fa fa-ban" style="font-size: 15px;"></i> Yazı Resimi<br/>
                    </div>';
                    header("Refresh:2; url=article-change.php");
                }
            }
            // Yer değiştirelecek ve Sub Page seçili
            elseif($page_degis == 4) {
                // Yer Sub Page olarak değiştiriliyor ve Resim de değişecek
                if($image_degis == 1) {
                    // Resimde veri var
                    if(isset($imageUrl)) {
                        if($imageSize > 50000000) {
                            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim boyutu <b>çok büyük</b> olmamalıdır !</div>";
                            header("Refresh:2; url=article-changed.php?articleChange=$id");
                        }
                        elseif(($imageType != "image/jpeg") && ($imageType != "image/jpg") && ($imageType != "image/png") && ($imageType != "image/gif")) {
                            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Resim'in formatı <b>JPEG, JPG, PNG veya GIF</b> olmalıdır !</div>";
                            header("Refresh:2; url=article-changed.php?articleChange=$id");
                        } else {
                            $imageUpload = move_uploaded_file($imageUrl, $imageHref.'/'.$imageRound.'-'.$imageName);
                            $NewPicture = $imageRound.'-'.$imageName;
                            $articleSQL = $pdo->prepare("
                            UPDATE article SET
                            page_id = 0,  subpage_id = '$subpage_id', category_id = 0, subcategory_id = 0,
                            article_name = '$article_name', article_info = '$article_info',
                            en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                            de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                            ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                            bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                            ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                            article_link = '$article_link', article_picture = '$NewPicture',
                            article_user = '$article_user', article_date = '$article_date'
                            WHERE id = '$id'");
                            $articleSQL->execute();
                            echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                            Değiştirilenler: <br/>
                            <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer: Kategori ve Yazı Resim<br/>
                            </div>';
                            header("Refresh:2; url=article-change.php");
                        }
                    }
                    // Resimde veri yok
                    else {
                        $articleSQL = $pdo->prepare("
                        UPDATE article SET
                        page_id = 0, subpage_id = '$subpage_id', category_id = 0, subcategory_id = 0,
                        article_name = '$article_name', article_info = '$article_info',
                        en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                        de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                        ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                        bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                        ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                        article_link = '$article_link', article_user = '$article_user', article_date = '$article_date'
                        WHERE id = '$id'");
                        $articleSQL->execute();
                        echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                        Değiştirilenler: <br/>
                        <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer: Alt Sayfa<br/>
                        </div>';
                        header("Refresh:2; url=article-change.php");
                    }
                }
                // Yer Sub Page olarak değiştiriliyor ve Resim değişmeyecek
                else {
                    $articleSQL = $pdo->prepare("
                    UPDATE article SET
                    page_id = 0, subpage_id = '$subpage_id', category_id = 0, subcategory_id = 0,
                    article_name = '$article_name', article_info = '$article_info',
                    en_article_name = '$en_article_name', en_article_info = '$en_article_info',
                    de_article_name = '$de_article_name', de_article_info = '$de_article_info',
                    ru_article_name = '$ru_article_name', ru_article_info = '$ru_article_info',
                    bg_article_name = '$bg_article_name', bg_article_info = '$bg_article_info',
                    ar_article_name = '$ar_article_name', ar_article_info = '$ar_article_info',
                    article_link = '$article_link', article_user = '$article_user', article_date = '$article_date'
                    WHERE id = '$id'");
                    $articleSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Yazı</b> başarıyla değiştirildi !<br/><br/>
                    Değişmeyenler: <br/>
                    <i class="fa fa-ban" style="font-size: 15px;"></i> Yazı Resimi<br/>
                    </div>';
                    header("Refresh:2; url=article-change.php");
                }
            }
            else {
                if($page_degis == 1 && $page_degis == 2 && $page_degis == 3) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Aynı anda <b>Sayfa, Kategori ve Alt Kategori</b> seçilemez !</div>";
                    header("Refresh:2; url=article-changed.php?articleChange=$id");
                }
                elseif($page_degis == 1 && $page_degis == 2) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Aynı anda <b>Sayfa ve Kategori</b> seçilemez !</div>";
                    header("Refresh:2; url=article-changed.php?articleChange=$id");
                }
                elseif($page_degis == 1 && $page_degis == 3) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Aynı anda <b>Sayfa ve Alt Kategori</b> seçilemez !</div>";
                    header("Refresh:2; url=article-changed.php?articleChange=$id");
                }
                elseif($page_degis == 2 && $page_degis == 3) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Aynı anda <b>Kategori ve Alt Kategori</b> seçilemez !</div>";
                    header("Refresh:2; url=article-changed.php?articleChange=$id");
                }
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
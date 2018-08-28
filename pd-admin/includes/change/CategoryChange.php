<?php
    function categoryChange($pdo) {
        $id = $_GET['categoryChange'];
        $page_id = $_POST['page_id'];
        $subpage_id = $_POST['subpage_id'];
        $category_name = $_POST['category_name'];
        $category_info = $_POST['category_info'];
        $en_category_name = $_POST['en_category_name'];
        $en_category_info = $_POST['en_category_info'];
        $de_category_name = $_POST['de_category_name'];
        $de_category_info = $_POST['de_category_info'];
        $ru_category_name = $_POST['ru_category_name'];
        $ru_category_info = $_POST['ru_category_info'];
        $bg_category_name = $_POST['bg_category_name'];
        $bg_category_info = $_POST['bg_category_info'];
        $ar_category_name = $_POST['ar_category_name'];
        $ar_category_info = $_POST['ar_category_info'];
        $category_user = $_POST['category_user'];
        $category_date = date('d.m.Y');
        $degisecek_yer = $_POST['degisecek_yer'];

        try {
            // Eklenecek Yer değiştirilmiyor
            if($degisecek_yer == 0) {
                $categorySQL = $pdo->prepare("UPDATE category SET
                category_name = '$category_name', category_info = '$category_info',
                en_category_name = '$en_category_name', en_category_info = '$en_category_info',
                de_category_name = '$de_category_name', de_category_info = '$de_category_info',
                ru_category_name = '$ru_category_name', ru_category_info = '$ru_category_info',
                bg_category_name = '$bg_category_name', bg_category_info = '$bg_category_info',
                ar_category_name = '$ar_category_name', ar_category_info = '$ar_category_info',
                category_user = '$category_user', category_date = '$category_date'
                WHERE id = '$id'");
                $categorySQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Kategori</b> başarıyla değiştirildi.<br/><br/>
                      Değişmeyenler: <br/>
                      <i class="fa fa-ban" style="font-size: 15px;"></i> Eklenecek Yer<br/>
                      </div>';
                header("Refresh:2; url=category-change.php");
            }
            // Eklenecek Yer Sayfa olarak değiştiriliyor
            elseif($degisecek_yer == 1) {
                $categorySQL = $pdo->prepare("UPDATE category SET
                page_id = '$page_id', subpage_id = 0, category_name = '$category_name', category_info = '$category_info',
                en_category_name = '$en_category_name', en_category_info = '$en_category_info',
                de_category_name = '$de_category_name', de_category_info = '$de_category_info',
                ru_category_name = '$ru_category_name', ru_category_info = '$ru_category_info',
                bg_category_name = '$bg_category_name', bg_category_info = '$bg_category_info',
                ar_category_name = '$ar_category_name', ar_category_info = '$ar_category_info',
                category_user = '$category_user', category_date = '$category_date'
                WHERE id = '$id'");
                $categorySQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Kategori</b> başarıyla değiştirildi.<br/><br/>
                      Değiştirilenler: <br/>
                      <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer<br/>
                      </div>';
                header("Refresh:2; url=category-change.php");
            }
            // Eklenecek Yer Alt Sayfa olarak değiştiriliyor
            elseif($degisecek_yer == 2) {
                $categorySQL = $pdo->prepare("UPDATE category SET
                page_id = 0, subpage_id = '$subpage_id', category_name = '$category_name', category_info = '$category_info',
                en_category_name = '$en_category_name', en_category_info = '$en_category_info',
                de_category_name = '$de_category_name', de_category_info = '$de_category_info',
                ru_category_name = '$ru_category_name', ru_category_info = '$ru_category_info',
                bg_category_name = '$bg_category_name', bg_category_info = '$bg_category_info',
                ar_category_name = '$ar_category_name', ar_category_info = '$ar_category_info',
                category_user = '$category_user', category_date = '$category_date'
                WHERE id = '$id'");
                $categorySQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Kategori</b> başarıyla değiştirildi.<br/><br/>
                      Değiştirilenler: <br/>
                      <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer<br/>
                      </div>';
                header("Refresh:2; url=category-change.php");
            }
            // Eklenecek Yer Sayfa ve Alt Sayfa seçilirse
            elseif($degisecek_yer == 1 && $degisecek_yer == 2) {
                echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen aynı anda, <b>Sayfa ve Alt Sayfa</b> seçimi yapayınız !</div>';
                header("Refresh:2; url=category-changed.php?categoryChange=$id");
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
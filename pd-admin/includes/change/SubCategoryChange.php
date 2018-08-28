<?php
    function subCategoryChange($pdo) {
        $id = $_GET['subCategoryChange'];
        $category_id = $_POST['category_id'];
        $subcategory_name = $_POST['subcategory_name'];
        $subcategory_info = $_POST['subcategory_info'];
        $en_subcategory_name = $_POST['en_subcategory_name'];
        $en_subcategory_info = $_POST['en_subcategory_info'];
        $de_subcategory_name = $_POST['de_subcategory_name'];
        $de_subcategory_info = $_POST['de_subcategory_info'];
        $ru_subcategory_name = $_POST['ru_subcategory_name'];
        $ru_subcategory_info = $_POST['ru_subcategory_info'];
        $bg_subcategory_name = $_POST['bg_subcategory_name'];
        $bg_subcategory_info = $_POST['bg_subcategory_info'];
        $ar_subcategory_name = $_POST['ar_subcategory_name'];
        $ar_subcategory_info = $_POST['ar_subcategory_info'];
        $subcategory_user = $_POST['subcategory_user'];
        $subcategory_date = date('d.m.Y');
        $degisecek_yer = $_POST['degisecek_yer'];

        try {
            // Eklenecek Yer değiştirilmiyor
            if($degisecek_yer == 0) {
                $subcategorySQL = $pdo->prepare("UPDATE subcategory SET
                    subcategory_name = '$subcategory_name', subcategory_info = '$subcategory_info',
                    en_subcategory_name = '$en_subcategory_name', en_subcategory_info = '$en_subcategory_info',
                    de_subcategory_name = '$de_subcategory_name', de_subcategory_info = '$de_subcategory_info',
                    ru_subcategory_name = '$ru_subcategory_name', ru_subcategory_info = '$ru_subcategory_info',
                    bg_subcategory_name = '$bg_subcategory_name', bg_subcategory_info = '$bg_subcategory_info',
                    ar_subcategory_name = '$ar_subcategory_name', ar_subcategory_info = '$ar_subcategory_info',
                    subcategory_user = '$subcategory_user', subcategory_date = '$subcategory_date'
                    WHERE id = '$id'");
                $subcategorySQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Alt Kategori</b> başarıyla değiştirildi.<br/><br/>
                      Değişmeyenler: <br/>
                      <i class="fa fa-ban" style="font-size: 15px;"></i> Eklenecek Yer<br/>
                      </div>';
                header("Refresh:2; url=subcategory-change.php");
            }
            // Eklenecek Yer Sayfa olarak değiştiriliyor
            elseif($degisecek_yer == 1) {
                $subcategorySQL = $pdo->prepare("UPDATE subcategory SET
                    category_id = '$category_id', subcategory_name = '$subcategory_name', subcategory_info = '$subcategory_info',
                    en_subcategory_name = '$en_subcategory_name', en_subcategory_info = '$en_subcategory_info',
                    de_subcategory_name = '$de_subcategory_name', de_subcategory_info = '$de_subcategory_info',
                    ru_subcategory_name = '$ru_subcategory_name', ru_subcategory_info = '$ru_subcategory_info',
                    bg_subcategory_name = '$bg_subcategory_name', bg_subcategory_info = '$bg_subcategory_info',
                    ar_subcategory_name = '$ar_subcategory_name', ar_subcategory_info = '$ar_subcategory_info',
                    subcategory_user = '$subcategory_user',
                    subcategory_date = '$subcategory_date' WHERE id = '$id'");
                $subcategorySQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Alt Kategori</b> başarıyla değiştirildi.<br/><br/>
                      Değiştirilenler: <br/>
                      <i class="fa fa-check" style="font-size: 15px;"></i> Eklenecek Yer<br/>
                      </div>';
                header("Refresh:2; url=subcategory-change.php");
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
                Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
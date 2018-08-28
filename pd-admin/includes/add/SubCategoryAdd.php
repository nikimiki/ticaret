<?php
    function subcategoryAdd($pdo) {
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
        $subcategory_date = date("d.m.Y");

        try {
            if($category_id == 0) {
                header('Refresh:2, url=subcategory-add.php');
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Kategori</b> seçiniz !</div>";
            }
            elseif($subcategory_name == '') {
                header('Refresh:2, url=subcategory-add.php');
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Alt Kategori Adını</b> yazınız !</div>";
            }
            elseif($subcategory_info == '') {
                header('Refresh:2, url=subcategory-add.php');
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Alt Kategori İçeriği</b> yazınız !</div>";
            } else {
                $categorySQL = $pdo->prepare("INSERT INTO subcategory (category_id, subcategory_name, subcategory_info,
                en_subcategory_name, en_subcategory_info, de_subcategory_name, de_subcategory_info,
                ru_subcategory_name, ru_subcategory_info, bg_subcategory_name, bg_subcategory_info,
                ar_subcategory_name, ar_subcategory_info,
                subcategory_user, subcategory_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $categorySQL->execute(array($category_id, $subcategory_name, $subcategory_info,
                $en_subcategory_name, $en_subcategory_info, $de_subcategory_name, $de_subcategory_info,
                $ru_subcategory_name, $ru_subcategory_info, $bg_subcategory_name, $bg_subcategory_info,
                $ar_subcategory_name, $ar_subcategory_info,
                $subcategory_user, $subcategory_date));

                header('Refresh:2, url=subcategorys.php');
                echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Alt Kategori</b> başarıyla eklenmiştir.</div>";
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
                Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
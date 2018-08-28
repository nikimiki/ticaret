<?php
    function categoryAdd($pdo) {
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
        $category_date = date("d.m.Y");

        $eklenecek_yer = $_POST['eklenecek_yer'];

        try {
            if($eklenecek_yer == 0) {
                if($page_id == 0) {
                    header('Refresh:2, url=category-add.php');
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Sayfa</b> seçiniz !</div>";
                }
                elseif($category_name == '') {
                    header('Refresh:2, url=category-add.php');
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Kategori Adını</b> yazınız !</div>";
                }
                elseif($category_info == '') {
                    header('Refresh:2, url=category-add.php');
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Kategori İçeriği</b> yazınız !</div>";
                } else {
                    $categorySQL = $pdo->prepare("
                            INSERT INTO category (page_id, subpage_id, category_name, category_info,
                            en_category_name, en_category_info, de_category_name, de_category_info,
                            ru_category_name, ru_category_info, bg_category_name, bg_category_info,
                            ar_category_name, ar_category_info,
                            category_user, category_date)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $categorySQL->execute(array($page_id, $subpage_id, $category_name, $category_info, $en_category_name, $en_category_info,
                    $de_category_name, $de_category_info, $ru_category_name, $ru_category_info, $bg_category_name, $bg_category_info,
                    $ar_category_name, $ar_category_info, $category_user, $category_date));

                    header('Refresh:2, url=categorys.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Kategori</b> başarıyla eklenmiştir.</div>";
                }
            }
            elseif($eklenecek_yer == 1) {
                if($subpage_id == 0) {
                    header('Refresh:2, url=category-add.php');
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Alt Sayfa</b> seçiniz !</div>";
                }
                elseif($category_name == '') {
                    header('Refresh:2, url=category-add.php');
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Kategori Adını</b> yazınız !</div>";
                }
                elseif($category_info == '') {
                    header('Refresh:2, url=category-add.php');
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Kategori İçeriği</b> yazınız !</div>";
                } else {
                    $categorySQL = $pdo->prepare("
                            INSERT INTO category (page_id, subpage_id, category_name, category_info,
                            en_category_name, en_category_info, de_category_name, de_category_info,
                            ru_category_name, ru_category_info, bg_category_name, bg_category_info,
                            ar_category_name, ar_category_info,
                            category_user, category_date)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $categorySQL->execute(array($page_id, $subpage_id, $category_name, $category_info, $en_category_name, $en_category_info,
                        $de_category_name, $de_category_info, $ru_category_name, $ru_category_info, $bg_category_name, $bg_category_info,
                        $ar_category_name, $ar_category_info, $category_user, $category_date));

                    header('Refresh:2, url=categorys.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Kategori</b> başarıyla eklenmiştir.</div>";
                }
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
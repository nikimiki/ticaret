<?php
    function subpageAdd($pdo) {
        $page_id = $_POST['page_id'];
        $subpage_name = $_POST['subpage_name'];
        $subpage_info = $_POST['subpage_info'];
        $en_subpage_name = $_POST['en_subpage_name'];
        $en_subpage_info = $_POST['en_subpage_info'];
        $de_subpage_name = $_POST['de_subpage_name'];
        $de_subpage_info = $_POST['de_subpage_info'];
        $ru_subpage_name = $_POST['ru_subpage_name'];
        $ru_subpage_info = $_POST['ru_subpage_info'];
        $bg_subpage_name = $_POST['bg_subpage_name'];
        $bg_subpage_info = $_POST['bg_subpage_info'];
        $ar_subpage_name = $_POST['ar_subpage_name'];
        $ar_subpage_info = $_POST['ar_subpage_info'];
        $subpage_user = $_POST['subpage_user'];
        $subpage_date = date("d.m.Y");

        try {
            if($page_id == 0) {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Sayfa</b> seçiniz !</div>";
                header('Refresh:2, url=subpage-add.php');
            } elseif($subpage_name == '') {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Alt Sayfa Başlığı</b> yazınız !</div>";
                header('Refresh:2, url=subpage-add.php');
            } elseif($subpage_info == '') {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen, <b>Alt Sayfa İçeriği</b> yazınız !</div>";
                header('Refresh:2, url=subpage-add.php');
            } else {
                $subpageSQL = $pdo->prepare("INSERT INTO subpage
                (page_id, subpage_name, subpage_info, en_subpage_name, en_subpage_info, de_subpage_name, de_subpage_info,
                 ru_subpage_name, ru_subpage_info, bg_subpage_name, bg_subpage_info, ar_subpage_name, ar_subpage_info,
                 subpage_user, subpage_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $subpageSQL->execute(array($page_id, $subpage_name, $subpage_info, $en_subpage_name, $en_subpage_info,
                $de_subpage_name, $de_subpage_info, $ru_subpage_name, $ru_subpage_info, $bg_subpage_name, $bg_subpage_info,
                $ar_subpage_name, $ar_subpage_info, $subpage_user, $subpage_date));

                header('Refresh:2, url=subpages.php');
                echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Alt Sayfa</b> başarıyla eklenmiştir.</div>";
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
                Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
<?php
    function subpageChange($pdo) {
        $id = $_GET['subPageChange'];
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
        $subpage_date = date('d.m.Y');
        $page_degis = $_POST['page_degis'];

        try {
            if($page_degis == 0) {
                $pageSQL = $pdo->prepare("UPDATE subpage SET
                subpage_name = '$subpage_name', subpage_info = '$subpage_info',
                en_subpage_name = '$en_subpage_name', en_subpage_info = '$en_subpage_info',
                de_subpage_name = '$de_subpage_name', de_subpage_info = '$de_subpage_info',
                ru_subpage_name = '$ru_subpage_name', ru_subpage_info = '$ru_subpage_info',
                bg_subpage_name = '$bg_subpage_name', bg_subpage_info = '$bg_subpage_info',
                ar_subpage_name = '$ar_subpage_name', ar_subpage_info = '$ar_subpage_info',
                subpage_user = '$subpage_user', subpage_date = '$subpage_date'
                WHERE id = '$id'");
                $pageSQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Alt Sayfa</b> başarıyla değiştirildi.</div>';
                header("Refresh:2; url=subpage-change.php");
            } elseif($page_degis == 1) {
                $pageSQL = $pdo->prepare("UPDATE subpage SET
                page_id = '$page_id',
                subpage_name = '$subpage_name', subpage_info = '$subpage_info',
                en_subpage_name = '$en_subpage_name', en_subpage_info = '$en_subpage_info',
                de_subpage_name = '$de_subpage_name', de_subpage_info = '$de_subpage_info',
                ru_subpage_name = '$ru_subpage_name', ru_subpage_info = '$ru_subpage_info',
                bg_subpage_name = '$bg_subpage_name', bg_subpage_info = '$bg_subpage_info',
                ar_subpage_name = '$ar_subpage_name', ar_subpage_info = '$ar_subpage_info',
                subpage_user = '$subpage_user', subpage_date = '$subpage_date'
                WHERE id = '$id'");
                $pageSQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Alt Sayfa</b> başarıyla değiştirildi.</div>';
                header("Refresh:2; url=subpage-change.php");
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
                Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
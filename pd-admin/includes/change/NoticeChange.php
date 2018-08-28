<?php
    function noticeChange($pdo) {
        $id = $_GET['noticeChange'];
        $notice_name = $_POST['notice_name'];
        $notice_info = $_POST['notice_info'];
        $en_notice_name = $_POST['en_notice_name'];
        $en_notice_info = $_POST['en_notice_info'];
        $de_notice_name = $_POST['de_notice_name'];
        $de_notice_info = $_POST['de_notice_info'];
        $ru_notice_name = $_POST['ru_notice_name'];
        $ru_notice_info = $_POST['ru_notice_info'];
        $bg_notice_name = $_POST['bg_notice_name'];
        $bg_notice_info = $_POST['bg_notice_info'];
        $ar_notice_name = $_POST['ar_notice_name'];
        $ar_notice_info = $_POST['ar_notice_info'];
        $notice_user = $_POST['notice_user'];
        $notice_date = date('d.m.Y');

        try {
            $noticeSQL = $pdo->prepare("UPDATE notice SET notice_name = '$notice_name', notice_info = '$notice_info',
            en_notice_name = '$en_notice_name', en_notice_info = '$en_notice_info',
            de_notice_name = '$de_notice_name', de_notice_info = '$de_notice_info',
            ru_notice_name = '$ru_notice_name', ru_notice_info = '$ru_notice_info',
            bg_notice_name = '$bg_notice_name', bg_notice_info = '$bg_notice_info',
            ar_notice_name = '$ar_notice_name', ar_notice_info = '$ar_notice_info',
            notice_user = '$notice_user', notice_date = '$notice_date'
            WHERE id = '$id'");
            $noticeSQL->execute();
            echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Duyuru</b> başarıyla değiştirildi !</div>';
            header("Refresh:2; url=notice-change.php");
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
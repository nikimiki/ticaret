<?php
    function pageChange($pdo) {
        $id = $_GET['pageChange'];
        $page_name = $_POST['page_name'];
        $page_info = $_POST['page_info'];
        $en_page_name = $_POST['en_page_name'];
        $en_page_info = $_POST['en_page_info'];
        $de_page_name = $_POST['de_page_name'];
        $de_page_info = $_POST['de_page_info'];
        $ru_page_name = $_POST['ru_page_name'];
        $ru_page_info = $_POST['ru_page_info'];
        $bg_page_name = $_POST['bg_page_name'];
        $bg_page_info = $_POST['bg_page_info'];
        $ar_page_name = $_POST['ar_page_name'];
        $ar_page_info = $_POST['ar_page_info'];
        $page_user = $_POST['page_user'];
        $page_date = date('d.m.Y');

        try {
            $pageSQL = $pdo->prepare("UPDATE page SET
            page_name = '$page_name', page_info = '$page_info', en_page_name = '$en_page_name', en_page_info = '$en_page_info', de_page_name = '$de_page_name',
             de_page_info = '$de_page_info', ru_page_name = '$ru_page_name', ru_page_info = '$ru_page_info', bg_page_name = '$bg_page_name',
             bg_page_info = '$bg_page_info', ar_page_name= '$ar_page_name', ar_page_info = '$ar_page_info', page_user = '$page_user', page_date = '$page_date'
            WHERE id = '$id'");
            $pageSQL->execute();
            echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Sayfa</b> başarıyla değiştirildi.</div>';
            header("Refresh:2; url=page-change.php");
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
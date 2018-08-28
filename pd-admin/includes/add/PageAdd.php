<?php
    function pageAdd($pdo) {
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
        $page_date = date("d.m.Y");

        try {
            $pageSQL = $pdo->prepare("
                            INSERT INTO page (page_name, page_info, en_page_name, en_page_info, de_page_name, de_page_info, ru_page_name, ru_page_info,
                             bg_page_name, bg_page_info, ar_page_name, ar_page_info, page_user, page_date)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $pageSQL->execute(array($page_name, $page_info, $en_page_name, $en_page_info, $de_page_name, $de_page_info, $ru_page_name, $ru_page_info,
                $bg_page_name, $bg_page_info, $ar_page_name, $ar_page_info, $page_user, $page_date));

            header('Refresh:2, url=pages.php');
            echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Sayfa</b> başarıyla eklenmiştir.</div>";
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>
<?php
    function YourName($pdo) {
        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
        echo $oturum['user_name'];
    }
    function SpecialTotalPage($pdo) {
        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
        $pageSQL = $pdo->prepare('SELECT * FROM page WHERE page_user = "'.$oturum['id'].'"');
        $pageSQL->execute();
        $yourPage = $pageSQL->rowCount();
        echo $yourPage;
    }
    function SpecialTotalCategory($pdo) {
        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
        $categorySQL = $pdo->prepare('SELECT * FROM category WHERE category_user = "'.$oturum['id'].'"');
        $categorySQL->execute();
        $yourCategory = $categorySQL->rowCount();
        echo $yourCategory;
    }
    function SpecialTotalArticle($pdo) {
        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
        $articleSQL = $pdo->prepare('SELECT * FROM article WHERE article_user = "'.$oturum['id'].'"');
        $articleSQL->execute();
        $yourArticle = $articleSQL->rowCount();
        echo $yourArticle;
    }
    function SpecialTotalNotice($pdo) {
        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
        $noticeSQL = $pdo->prepare('SELECT * FROM notice WHERE notice_user = "'.$oturum['id'].'"');
        $noticeSQL->execute();
        $yourNotice = $noticeSQL->rowCount();
        echo $yourNotice;
    }
    function SpecialForYou($pdo) {
        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
        if ($oturum['picture'] == '') {
            echo '<img src="images/logo-picture.jpg" alt="'.$oturum['user_name'].' - Profil Resmi"/>';
        } else {
            echo '<img src="pic/'.$oturum['picture'].'"  alt="'.$oturum['user_name'].' - Profil Resmi"/>';
        }
        echo '<p>Merhaba '.$oturum['ad'].'&nbsp;'.$oturum['soyad'].'</p>';
        echo '<p><i class="fa fa-calendar" title="Kayıt Tarihi"></i> '.$oturum['user_date'].'</p>';
        if(($oturum['kayit_tur'] == 1) || ($oturum['kayit_tur'] == 2) || ($oturum['kayit_tur'] == 3)) {
            if (($oturum['kayit_tur'] == 1)) { echo '<p style="color: #C00;"><i class="fa fa-user" style="color: #666;"></i>Yönetici</p>'; }
            elseif (($oturum['kayit_tur'] == 2)) { echo '<p style="color:#ed6c44;"><i class="fa fa-user" style="color: #666;"></i>Moderatör</p>'; }
            elseif (($oturum['kayit_tur'] == 3)) { echo '<p style="color:#d8c20c;"><i class="fa fa-user" style="color: #666;"></i>Yazar</p>'; }
        }
        echo '<p><i class="fa fa-power-off"></i></p>';
    }
?>
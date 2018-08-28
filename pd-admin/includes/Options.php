<?php
    function HomeOptions($pdo) {
        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
        echo '
                <div class="HomeOptions">
					<a href="profil.php?userView='.$oturum['id'].'"><i class="fa fa-sliders HO-Slider" style="margin-right: 20px;" title="Profil"></i></a>
					<a href="profil-picture.php?userView='.$oturum['id'].'"><i class="fa fa-upload" title="Profil Resmi"></i></a>
				</div>
        ';
    }
    function ProfilTab($pdo) {
        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
        echo '
                <div class="HomeProfileTab">
					<p>'.$oturum['ad'].'&nbsp;'.$oturum['soyad'].'</p>
					<img src="';
            if(empty($oturum['picture'])) { echo 'images/logo-picture.jpg'; }
            else { echo 'pic/'.$oturum['picture'].''; }
        echo '" class="HomeProfileIcon" alt="Profil Picture" /></div>';
    }
    function AnotherOption() {
        echo '
                <div class="MoreOptions">
					<a href="includes/login/logout.php"><p style="background-color: #4bc5c3;"><i class="fa fa-power-off"></i></p></a>
					<p><i class="fa fa-bars"></i></p>
				</div>
        ';
    }
?>
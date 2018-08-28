<?php
    function TotalInformationRight($pdo) {
        echo '
                <div class="ScoreBarTab">
					<p>Firma Bilgisi</p>
					<p>';
					$date = strtotime("July 31, 2019 2:00 PM");
                    $remaining = $date - time();
                    $days_remaining = floor($remaining / 86400);
                    $hours_remaining = floor(($remaining % 86400) / 3600);
        echo $days_remaining .'&nbsp;Gün';
        echo '&nbsp;'.$hours_remaining .'&nbsp;Saat';
        echo'&nbsp;Kaldı</p>
					<div class="SBT-Ok"></div>
				</div>
				<div class="ScoreBarTab">
					<p>Toplam Giriş</p>
					<p>';include('counter.php');echo'</p>
				</div>
				<div class="ScoreBarTab">
					<p>Toplam Üye</p>
					<p>';
                $totalUser = $pdo->prepare("SELECT id FROM users");
                $totalUser->execute();
                $userCount = $totalUser->rowCount();
                echo $userCount;
        echo ' Kişi
                    </p>
				</div>
        ';
    }
    function SiteOfficer($pdo) {
        echo '<div class="AdminsTabsHeader">Site Görevlileri</div>';
        $sOfficer = $pdo->prepare("SELECT * FROM users WHERE kayit_tur = 1 || 2 || 3 ORDER BY kayit_tur ASC LIMIT 10");
        $sOfficer->execute();
        $sOfficerRec = $sOfficer->fetchAll();
        foreach($sOfficerRec as $siteOfficer) {
            if (($siteOfficer['kayit_tur'] == 1) || ($siteOfficer['kayit_tur'] == 2) || ($siteOfficer['kayit_tur'] == 3)) {
                echo '
                <div class="AdminsTab">
					<img src="';
                if ($siteOfficer['picture'] == '') {
                    echo 'images/logo-picture.jpg';
                } else {
                    echo 'pic/'.$siteOfficer['picture'].'';
                }
                echo '
                 " style="width:40px;height:40px;" alt="Site Officer İcon"/>
					<p>' . $siteOfficer['user_name'] . '</p>
					<p>';
                    if (($siteOfficer['kayit_tur'] == 1)) { echo '<span style="color: #C00;">Yönetici</span>'; }
                    elseif (($siteOfficer['kayit_tur'] == 2)) { echo '<span style="color:#ed6c44;">Moderatör</span>'; }
                    elseif (($siteOfficer['kayit_tur'] == 3)) { echo '<span style="color:#d8c20c;">Yazar</span>'; }
                echo '
                    </p>
				</div>
            ';
            }
        }
    }
?>
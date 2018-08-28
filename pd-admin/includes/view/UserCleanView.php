<?php
    function UserCleanView($pdo) {
        $adjacents = 2;
        $STM = $pdo->prepare("SELECT id FROM users ");
        $STM->execute();
        $Records = $STM->rowCount();
        $limit = 21;
        @$page = $_GET['page'];
        if($page) { $start = ($page-1) * $limit; }
        else { $start = 0; }

        $STM2 = $pdo->prepare("SELECT * FROM users ORDER BY id DESC LIMIT $start, $limit");
        $STM2->execute();
        $STMRecords = $STM2->fetchAll();

        if($page == 0) { $page = 1; }
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($Records/$limit);
        $lpm1 = $lastpage - 1;
        $pagination = "";

        if($lastpage > 1) {
            //$pagination .= "<div class='UserMainBottom'>";
            if($page > 1) { $pagination.= "<p><a href='$targetpage?$page=$prev'><i class='fa fa-chevron-left'></i></a></p>"; }
            else { $pagination.= "<p><i class='fa fa-chevron-left'></i></p>"; }
            if($lastpage < 7 + ($adjacents * 2)) {
                for($counter = 1; $counter <= $lastpage; $counter++) {
                    if($counter == $page) { $pagination.= "<p>$counter</p>"; }
                    else { $pagination.= "<p><a href='$targetpage?page=$counter'>$counter</a></p>"; }
                }
            }
            elseif($lastpage > 5 + ($adjacents * 2)) {
                if($page < 1 + ($adjacents * 2)) {
                    for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if($counter == $page) { $pagination.= "<p>$counter</p>"; }
                        else { $pagination.= "<p><a href='$targetpage?page=$counter'>$counter</a></p>"; }
                    }
                    $pagination.= "<p>...</p>";
                    $pagination.= "<p><a href='$targetpage?page=$lpm1'>$lpm1</a></p>";
                    $pagination.= "<p><a href='$targetpage?page=$lastpage'>$lastpage</a></p>";
                }
                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination.= "<p><a href='$targetpage?page=1'>1</a></p>";
                    $pagination.= "<p><a href='$targetpage?page=2'>2</a></p>";
                    $pagination.= "<p>...</p>";
                    for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){
                        if($counter == $page) { $pagination.= "<p>$counter</p>"; }
                        else { $pagination.= "<p><a href='$targetpage?page=$counter'>$counter</a></p>"; }
                        $pagination.= "<p>...</p>";
                        $pagination.= "<p><a href='$targetpage?page=$lpm1'>$lpm1</a></p>";
                        $pagination.= "<p><a href='$targetpage?page=$lastpage'>$lastpage</a></p>";
                    }
                }
                else {
                    $pagination.= "<p><a href='$targetpage?page=1'>1</a></p>";
                    $pagination.= "<p><a href='$targetpage?page=2'>2</a></p>";
                    $pagination.= "<p>...</p>";
                    for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){
                        if($counter == $page){ $pagination.= "<p>$counter</p>"; }
                        else { $pagination.= "<p><a href='$targetpage?page=$counter'>$counter</a></p>"; }
                    }
                }
            }
            if($page < $counter - 1) { $pagination.= "<p><a href='$targetpage?page=$next'><i class='fa fa-chevron-right'></i></a></p>"; }
            else { $pagination.= "<p><i class='fa fa-chevron-right'></i></p>"; }
        }
        echo '<div class="UserMainCenter">';
        if(!isset($_POST['userSil'])) {
            echo '<form action="#" method="post">';
            foreach($STMRecords as $userView) {
                echo '<div class="UserMainCenter-Line">';
                echo '<p><input type="checkbox" name="userClean[]" value="'.$userView['id'].'" /></p>';
                if($userView['cinsiyet'] == 1) { echo '<p><i class="fa fa-male" style="color: #314a61;"></i></p>'; }
                else { echo '<p><i class="fa fa-female" style="color: #C00;"></i></p>'; }
                if($userView['kayit_tur'] == 1) { echo '<p style="color: #C00;">'.mb_substr($userView['user_name'], 0, 10, 'UTF-8').'</p>'; }
                elseif($userView['kayit_tur'] == 2) { echo '<p style="color: #ed6c44;">'.mb_substr($userView['user_name'], 0, 10, 'UTF-8').'</p>'; }
                elseif($userView['kayit_tur'] == 3) { echo '<p style="color: #d8c20c;">'.mb_substr($userView['user_name'], 0, 10, 'UTF-8').'</p>'; }
                else { echo '<p>'.mb_substr($userView['user_name'], 0, 10, 'UTF-8').'</p>'; }
                echo '
					<p>'.mb_substr($userView['ad'], 0, 15, 'UTF-8').'&nbsp;'.mb_substr($userView['soyad'], 0, 15, 'UTF-8').'</p>
					<p>'.mb_substr($userView['email'], 0, 28, 'UTF-8').'</p>
                    <p>'.$userView['user_date'].'</p>';
                echo '</div>';
            }
            echo '<div class="UserMainCenter-Line"><button onClick="return confirmDelete();" name="userSil"><i class="fa fa-times-circle"></i>SİL</button></div>';
            echo '</form>';
        } else { userClean($pdo); }
        echo '</div>';
        echo '<div class="UserMainBottom">'.$pagination.'</div>';
    }
?>
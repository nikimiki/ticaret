<?php
    function SubPageCleanView($pdo) {
        $adjacents = 2;
        $Data = $pdo->prepare("SELECT id FROM subpage ");
        $Data->execute();
        $Records = $Data->rowCount();
        $limit = 24;
        @$page = $_GET['page'];
        if($page) { $start = ($page-1) * $limit; }
        else { $start = 0; }

        $Data2 = $pdo->prepare("SELECT
            subpage.id as SubPID, subpage.page_id, subpage.subpage_name, subpage.subpage_date, subpage.subpage_user,
            page.id as PID, page.page_name,
            users.id, users.user_name
            FROM subpage
            LEFT JOIN page ON subpage.page_id = page.id
            INNER JOIN users ON subpage.subpage_user = users.id
            ORDER BY SubPID DESC LIMIT $start, $limit");
        $Data2->execute();
        $DataRecords = $Data2->fetchAll();

        if($page == 0) { $page = 1; }
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($Records/$limit);
        $lpm1 = $lastpage - 1;
        $pagination = "";

        if($lastpage > 1) {
            //$pagination .= "<div class='PageMainBottom'>";
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
                        if($counter == $page) { $pagination.= "<p>$counter</p>"; }
                        else { $pagination.= "<p><a href='$targetpage?page=$counter'>$counter</a></p>"; }
                    }
                }
            }
            if($page < $counter - 1) { $pagination.= "<p><a href='$targetpage?page=$next'><i class='fa fa-chevron-right'></i></a></p>"; }
            else { $pagination.= "<p><i class='fa fa-chevron-right'></i></p>"; }
        }
        echo '<div class="SubPageMainCenter">';
        if(!isset($_POST['subpageSil'])) {
            foreach ($DataRecords as $pageView) {
                echo '<form action="#" method="post">';
                echo '<div class="SubPageMainCenter-Line">';
                echo '<p><input type="checkbox" name="subpageClean[]" value="'.$pageView['SubPID'].'" /></p>';
                echo '<p>'.mb_substr($pageView['subpage_name'], 0, 55, 'UTF-8').'</p>
                      <p>';
                if($pageView['PID'] == $pageView['page_id']) { echo mb_substr($pageView['page_name'], 0, 20, 'UTF-8'); }
                else { echo '<i class="fa fa-fire" style="color: #F0310C;" title="Eklendiği yer bulunamadı !"></i>'; }
                echo '
                      <p>'.$pageView['subpage_date'].'</p>
                      <p>'.$pageView['user_name'].'</p>';
                echo '</div>';
            }
            echo '<div class="SubPageMainCenter-Line"><button onClick="return confirmDelete();" name="subpageSil"><i class="fa fa-times-circle"></i>SİL</button></div>';
            echo '</form>';
        } else { subpageClean($pdo); }
        echo '</div>';
        echo '<div class="SubPageMainBottom">'.$pagination.'</div>';
    }
?>
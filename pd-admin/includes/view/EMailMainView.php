<?php
    function EMailMainView($pdo) {
        $adjacents = 2;
        $STM = $pdo->prepare("SELECT id FROM email ");
        $STM->execute();
        $Records = $STM->rowCount();
        $limit = 48;
        @$page = $_GET['page'];
        if($page) { $start = ($page-1) * $limit; }
        else { $start = 0; }

        $STM2 = $pdo->prepare("SELECT * FROM email ORDER BY id DESC LIMIT $start, $limit");
        $STM2->execute();
        $STMRecords = $STM2->fetchAll();

        if($page == 0) { $page = 1; }
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($Records/$limit);
        $lpm1 = $lastpage - 1;
        $pagination = "";

        if($lastpage > 1) {
            //$pagination .= "<div class='EMailMainBottom'>";
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
        echo '<div class="EMailMainCenter">';
        foreach($STMRecords as $emailView) {
            echo '<div class="EMailMainCenter-Line">';
            echo '<p><i class="fa fa-binoculars"></i></p>';
            echo '
                        <p>'.mb_substr($emailView['email'], 0, 30, 'UTF-8').'</p>
                        <p>'.$emailView['email_date'].'</p>
                ';
            echo '</div>';
        }
        echo '</div>';
        echo '<div class="EMailMainBottom">'.$pagination.'</div>';
    }
?>
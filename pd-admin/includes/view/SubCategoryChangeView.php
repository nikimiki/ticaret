<?php
    function SubCategoryChangeView($pdo) {
        $adjacents = 2;
        $STM = $pdo->prepare("SELECT id FROM subcategory ");
        $STM->execute();
        $Records = $STM->rowCount();
        $limit = 24;
        @$page = $_GET['page'];
        if($page) { $start = ($page-1) * $limit; }
        else { $start = 0; }

        $STM2 = $pdo->prepare("SELECT
            category.id as CID, category.category_name, users.id, users.user_name,
            subcategory.id as SubCID, subcategory.category_id, subcategory.subcategory_name, subcategory.subcategory_date, subcategory.subcategory_user
            FROM subcategory
            LEFT JOIN category ON subcategory.category_id = category.id
            INNER JOIN users ON subcategory.subcategory_user = users.id
            ORDER BY subcategory.id DESC LIMIT $start, $limit");
        $STM2->execute();
        $STMRecords = $STM2->fetchAll();

        if($page == 0) { $page = 1; }
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($Records/$limit);
        $lpm1 = $lastpage - 1;
        $pagination = "";

        if($lastpage > 1) {
            //$pagination .= "<div class='SubCategoryMainBottom'>";
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
        echo '<div class="SubCategoryMainCenter">';
        foreach($STMRecords as $subCategoryView) {
            echo '<div class="SubCategoryMainCenter-Line">';
            echo '<a href="subcategory-changed.php?subCategoryChange='.$subCategoryView['SubCID'].'"><p><i class="fa fa-exchange"></i></p></a>';
            echo '
                            <p>'.mb_substr($subCategoryView['subcategory_name'], 0, 40, 'UTF-8').'</p>
                            <p>';
            if($subCategoryView['CID'] == $subCategoryView['category_id']) { echo mb_substr($subCategoryView['category_name'], 0, 15, 'UTF-8'); }
            else { echo '<i class="fa fa-fire" style="color: #F0310C;" title="Eklendiği yer bulunamadı !"></i>'; }
            echo '      </p>
                            <p>'.$subCategoryView['subcategory_date'].'</p>
                            <p>'.$subCategoryView['user_name'].'</p>';
            echo '</div>';
        }
        echo '</div>';
        echo '<div class="SubCategoryMainBottom">'.$pagination.'</div>';
    }
?>
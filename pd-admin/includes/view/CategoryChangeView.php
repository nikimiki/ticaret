<?php
function CategoryChangeView($pdo) {
    $adjacents = 2;
    $STM = $pdo->prepare("SELECT id FROM category");
    $STM->execute();
    $Records = $STM->rowCount();
    $limit = 24;
    @$page = $_GET['page'];
    if($page) { $start = ($page-1) * $limit; }
    else { $start = 0; }

    $STM2 = $pdo->prepare("SELECT
            page.id as PID, page.page_name,
            subpage.id as SubPID, subpage.subpage_name,
            users.id, users.user_name,
            category.id as CID, category.page_id, category.subpage_id, category.category_name, category.category_date, category.category_user
            FROM category
            LEFT JOIN subpage ON category.subpage_id = subpage.id
            LEFT JOIN page ON category.page_id = page.id
            INNER JOIN users ON category.category_user = users.id
            ORDER BY category.id DESC LIMIT $start, $limit");
    $STM2->execute();
    $STMRecords = $STM2->fetchAll();

    if($page == 0) { $page = 1; }
    $prev = $page - 1;
    $next = $page + 1;
    $lastpage = ceil($Records/$limit);
    $lpm1 = $lastpage - 1;
    $pagination = "";
    $targetpage = "";

    if($lastpage > 1) {
        //$pagination .= "<div class='CategoryMainBottom'>";
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
    echo '<div class="CategoryMainCenter">';
    foreach($STMRecords as $categoryView) {
        echo '<div class="CategoryMainCenter-Line">';
        echo '<a href="category-changed.php?categoryChange='.$categoryView['CID'].'" title="'.$categoryView['CID'].'"><p><i class="fa fa-exchange"></i></p></a>';
        echo '
                    <p>'.mb_substr($categoryView['category_name'], 0, 50, 'UTF-8').'</p>';
        echo '  <p>';
        if(($categoryView['page_id'] == $categoryView['PID']) || ($categoryView['subpage_id'] == $categoryView['SubPID'])) {
            if(($categoryView['PID'] == $categoryView['page_id'])) { echo mb_substr($categoryView['page_name'], 0, 20, 'UTF-8'); }
            elseif(($categoryView['SubPID'] == $categoryView['subpage_id'])) { echo mb_substr($categoryView['subpage_name'], 0, 20, 'UTF-8'); }
        } else { echo '<i class="fa fa-fire" style="color: #F0310C;" title="Eklendiği yer bulunamadı !"></i>'; }
        echo '  </p>
                    <p>'.$categoryView['category_date'].'</p>
                    <p>'.$categoryView['user_name'].'</p>

            ';
        echo '</div>';
    }
    echo '</div>';
    echo '<div class="CategoryMainBottom">'.$pagination.'</div>';
}
?>
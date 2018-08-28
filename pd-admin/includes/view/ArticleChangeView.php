<?php
    function ArticleChangeView($pdo) {
        $adjacents = 2;
        $STM = $pdo->prepare("SELECT id FROM article ");
        $STM->execute();
        $Records = $STM->rowCount();
        $limit = 24;
        @$page = $_GET['page'];
        if($page) { $start = ($page-1) * $limit; }
        else { $start = 0; }

        $STM2 = $pdo->prepare("SELECT
        article.id as AID, article.page_id, article.subpage_id, article.category_id, article.subcategory_id, article.article_name, article.article_user, article.article_date,
        category.id as CID, category.category_name,
        page.id as PID, page.page_name,
        subpage.id as SubPID, subpage.subpage_name,
        subcategory.id as SubCID, subcategory.subcategory_name,
        users.id, users.user_name
        FROM article
        LEFT JOIN category ON category.id = article.category_id
        LEFT JOIN page ON page.id = article.page_id
        LEFT JOIN subpage ON subpage.id = article.subpage_id
        LEFT JOIN subcategory ON subcategory.id = article.subcategory_id
        INNER JOIN users ON users.id = article.article_user
        ORDER BY AID DESC LIMIT $start, $limit");
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
        echo '<div class="ArticleMainCenter">';
        foreach($STMRecords as $articleView) {
            echo '<div class="ArticleMainCenter-Line">';
            echo '<a href="article-changed.php?articleChange='.$articleView['AID'].'"><p><i class="fa fa-exchange"></i></p></a>';
            echo ' <p>'.mb_substr($articleView['article_name'], 0, 50).'</p> <p>';
            if(($articleView['page_id'] == $articleView['PID']) || ($articleView['category_id'] == $articleView['CID']) || ($articleView['subcategory_id'] == $articleView['SubCID']) || ($articleView['subpage_id'] == $articleView['SubPID'])) {
                if($articleView['page_id'] == $articleView['PID']) { echo mb_substr($articleView['page_name'], 0, 20, 'UTF-8'); }
                elseif($articleView['category_id'] == $articleView['CID']) { echo mb_substr($articleView['category_name'], 0, 20, 'UTF-8'); }
                elseif($articleView['subcategory_id'] == $articleView['SubCID']) { echo mb_substr($articleView['subcategory_name'], 0, 20, 'UTF-8'); }
                elseif($articleView['subpage_id'] == $articleView['SubPID']) { echo mb_substr($articleView['subpage_name'], 0, 20, 'UTF-8'); }
            } else { echo '<i class="fa fa-fire" style="color: #F0310C;" title="Eklendiği yer bulunamadı !"></i>'; }
            echo '</p> 
            <p>'.$articleView['article_date'].'</p> 
            <p style="color: #C00;">'.mb_substr($articleView['user_name'], 0, 15).'</p>  ';
            echo '</div>';
        }

        echo '</div>';
        echo '<div class="ArticleMainBottom">'.$pagination.'</div>';
    }
?>
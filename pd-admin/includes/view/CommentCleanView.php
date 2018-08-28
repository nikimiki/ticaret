<?php
    function CommentCleanView($pdo) {
        $adjacents = 2;
        $STM = $pdo->prepare("SELECT id FROM comment ");
        $STM->execute();
        $Records = $STM->rowCount();
        $limit = 24;
        @$page = $_GET['page'];
        if($page) { $start = ($page-1) * $limit; }
        else { $start = 0; }

        $STM2 = $pdo->prepare("SELECT
                article.id, article.article_name, comment.id as CommentID, comment.article_id, comment.ad_soyad, comment.comment, comment.comment_onay, comment_date
                FROM comment
                LEFT JOIN article
                ON article.id = comment.article_id
                ORDER BY comment.comment_onay ASC LIMIT $start, $limit");
        $STM2->execute();
        $STMRecords = $STM2->fetchAll();

        if($page == 0) { $page = 1; }
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($Records/$limit);
        $lpm1 = $lastpage - 1;
        $pagination = "";

        if($lastpage > 1) {
            //$pagination .= "<div class='CommentMainBottom'>";
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
        echo '<div class="CommentMainCenter">';
        if(!isset($_POST['commentSil'])) {
            echo '<form action="#" method="post">';
            foreach($STMRecords as $commentView) {
                echo '<div class="CommentMainCenter-Line">';
                echo '<p><input type="checkbox" name="commentClean[]" value="'.$commentView['CommentID'].'" /></p>';
                echo '
                    <p>'.mb_substr($commentView['comment'], 0, 35, 'UTF-8').'</p>';
                if($commentView['comment_onay'] == 1) { echo '<p>Onaysız</p>'; }
                else { echo '<p style="color: #9ad717">Onaylı</p>'; }
                echo '
                    <p>'.mb_substr($commentView['article_name'], 0, 15, 'UTF-8').'</p>
                    <p>'.$commentView['comment_date'].'</p>
                    <p>'.mb_substr($commentView['ad_soyad'],0 ,20, 'UTF-8').'</p>

                ';
                echo '</div>';
            }
            echo '<div class="CommentMainCenter-Line"><button onClick="return confirmDelete();" name="commentSil"><i class="fa fa-times-circle"></i>SİL</button></div>';
            echo '</form>';
        } else { commentClean($pdo); }
        echo '</div>';
        echo '<div class="CommentMainBottom">'.$pagination.'</div>';
    }
?>
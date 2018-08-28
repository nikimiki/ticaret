<?php
    function PictureMainView($pdo) {
        if(isset($_POST['siraDegis'])) {
            $sira_id = $_POST['id'];
            $sira = $_POST['sira'];
            $siraSQL = $pdo->prepare("UPDATE picture SET sira = '$sira' WHERE id = '$sira_id'");
            $siraSQL->execute();

            $bar = $_SERVER['REQUEST_URI'];
            $bar_explode = explode('?', $bar);
            $bar_show = $bar_explode[1];

            echo '
                <script>
                alert("Resim Sıralaması başarıyla değiştirildi !");
                location.href = "pictures.php?'.$bar_show.'";
                </script>
            ';
        }
        $adjacents = 2;
        $STM = $pdo->prepare("SELECT id FROM picture ");
        $STM->execute();
        $Records = $STM->rowCount();
        $limit = 9;
        @$page = $_GET['page'];
        if($page) { $start = ($page-1) * $limit; }
        else { $start = 0; }

        $STM2 = $pdo->prepare("SELECT picture.id as PID, picture.article_id, picture.category_id, picture.subcategory_id,
        picture.sira, picture.picture_name, picture.picture,
        article.id as AID, article.article_name,
        category.id as CID, category.category_name,
        subcategory.id as SID, subcategory_name
        FROM picture
        LEFT JOIN article ON article.id = picture.article_id
        LEFT JOIN category ON category.id = picture.category_id
        LEFT JOIN subcategory ON subcategory.id = picture.subcategory_id
        ORDER BY picture.id DESC LIMIT $start, $limit");
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
            //$pagination .= "<div class='PictureMainBottom'>";
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
        echo '<div class="PictureMainCenter">';
        foreach($STMRecords as $pictureView) {
            echo '<form action="" method="post">';
            echo '<div class="ImagesTab">';
            echo '
                    <img src="pic/'.$pictureView['picture'].'" alt="'.$pictureView['picture_name'].'" />
                    <input type="hidden" name="id" value="'.$pictureView['PID'].'"/>
                    <input type="text" name="sira" value="'.$pictureView['sira'].'"/><i class="fa fa-sort-numeric-asc"></i>
            ';
            if($pictureView['CID'] == $pictureView['category_id']) { echo '<p><b># '.$pictureView['category_name'].'</b>&nbsp;&nbsp;'; }
            echo mb_substr($pictureView['picture_name'], 0, 24, 'UTF-8').'</p>';
            echo '</div>';
            echo '<button name="siraDegis">SIRA DEĞİŞTİR</button>';
            echo '</form>';
        }


        echo '</div>';

        echo '<div class="PictureMainBottom">'.$pagination.'</div>';
    }
?>
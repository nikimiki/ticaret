<?php
    function commentView($pdo) {
        $commentSQL = $pdo->prepare("SELECT id, comment, comment_onay FROM comment WHERE comment_onay = 1 LIMIT 6");
        $commentSQL->execute();
        foreach($commentSQL as $commentView) {
            if($commentView['comment_onay'] == 1) {
                echo '<p><a href="comment-view.php?commentView='.$commentView['id'].'"><i class="fa fa-binoculars"></i>'.mb_substr($commentView['comment'], 0, 90, 'UTF-8').'</p></a>';
            }
        }
    }
?>
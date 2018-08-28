<?php
    function pageTotalCount($pdo) {
        $pageTotal = $pdo->prepare("SELECT id FROM page");
        $pageTotal->execute();
        $pageCount = $pageTotal->rowCount();
        echo $pageCount;
    }
    function subpageTotalCount($pdo) {
        $subpageTotal = $pdo->prepare("SELECT id FROM subpage");
        $subpageTotal->execute();
        $subpageCount = $subpageTotal->rowCount();
        echo $subpageCount;
    }
    function categoryTotalCount($pdo) {
        $categoryTotal = $pdo->prepare("SELECT id FROM category");
        $categoryTotal->execute();
        $categoryCount = $categoryTotal->rowCount();
        echo $categoryCount;
    }
    function subcategoryTotalCount($pdo) {
        $subcategoryTotal = $pdo->prepare("SELECT id FROM subcategory");
        $subcategoryTotal->execute();
        $subcategoryCount = $subcategoryTotal->rowCount();
        echo $subcategoryCount;
    }
    function articleTotalCount($pdo) {
        $articleTotal = $pdo->prepare("SELECT id FROM article");
        $articleTotal->execute();
        $articleCount = $articleTotal->rowCount();
        echo $articleCount;
    }
    function pictureTotalCount($pdo) {
        $pictureTotal = $pdo->prepare("SELECT id FROM picture");
        $pictureTotal->execute();
        $pictureCount = $pictureTotal->rowCount();
        echo $pictureCount;
    }
    function videoTotalCount($pdo) {
        $videoTotal = $pdo->prepare("SELECT id FROM video");
        $videoTotal->execute();
        $videoCount = $videoTotal->rowCount();
        echo $videoCount;
    }
    function userTotalCount($pdo) {
        $userTotal = $pdo->prepare("SELECT id FROM users");
        $userTotal->execute();
        $userCount = $userTotal->rowCount();
        echo $userCount;
    }
    function commentTotalCount($pdo) {
        $commentTotal = $pdo->prepare("SELECT id FROM comment");
        $commentTotal->execute();
        $commentCount = $commentTotal->rowCount();
        echo $commentCount;
    }
    function noticeTotalCount($pdo) {
        $noticeTotal = $pdo->prepare("SELECT id FROM notice");
        $noticeTotal->execute();
        $noticeCount = $noticeTotal->rowCount();
        echo $noticeCount;
    }
    function sliderTotalCount($pdo) {
        $sliderTotal = $pdo->prepare("SELECT id FROM slider");
        $sliderTotal->execute();
        $sliderCount = $sliderTotal->rowCount();
        echo $sliderCount;
    }
    function emailTotalCount($pdo) {
        $emailTotal = $pdo->prepare("SELECT id FROM email");
        $emailTotal->execute();
        $emailCount = $emailTotal->rowCount();
        echo $emailCount;
    }
    function muayeneTotalCount($pdo) {
        $muayeneTotal = $pdo->prepare("SELECT id FROM muayene");
        $muayeneTotal->execute();
        $muayeneCount = $muayeneTotal->rowCount();
        echo $muayeneCount;
    }
    function analizTotalCount($pdo) {
        $analizTotal = $pdo->prepare("SELECT id FROM foto_muayene");
        $analizTotal->execute();
        $analizCount = $analizTotal->rowCount();
        echo $analizCount;
    }
    function soruTotalCount($pdo) {
        $soruTotal = $pdo->prepare("SELECT id FROM soruform");
        $soruTotal->execute();
        $soruCount = $soruTotal->rowCount();
        echo $soruCount;
    }
?>
<?php
    function SearchingMainView($pdo) {
        $arama = trim($_POST['arama']);
        $arama_secenek = $_POST['arama_secenek'];
        if(strlen($arama) <= 2) {
            echo '<div class="SearchingMainCenter"><p>Lütfen daha uzun kelime giriniz</p></div>';
            header('Refresh:2; url=searching.php');
        }
        else {
            if ($arama_secenek == 1) {
                $articleSQL = $pdo->prepare("SELECT article.id as AID, article.article_name, article.article_user, article.article_date, users.id, users.user_name
                FROM article
                INNER JOIN users ON users.id = article.article_user
                WHERE article_name LIKE '%$arama%' LIMIT 28");
                $articleSQL->execute();

                $articleRow = $articleSQL->rowCount();
                if($articleRow <= 0) { echo '
                    <div class="SearchingMainCenter">
                        <p><b style="color: #C00;">'.$arama.'</b> &nbsp;bulunamadı !</p>
                    </div>
                ';
                    header('Refresh:2; url=searching.php');
                }
                else {
                    echo '<div class="SearchingMainCenter">';
                    foreach ($articleSQL as $articleView) {
                        echo '<div class="SearchingMainCenter-Line">';
                        echo '<a href="article-view.php?articleView=' . $articleView['AID'] . '"><p><i class="fa fa-binoculars"></i></p></a>
                        <p>' . mb_substr($articleView['article_name'], 0, 70, 'UTF-8') . '</p>
                        <p>' . mb_substr($articleView['user_name'], 0, 13, 'UTF-8') . '</p>
                        <p>' . $articleView['article_date'] . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            } elseif ($arama_secenek == 2) {
                $pageSQL = $pdo->prepare("SELECT page.id as PID, page.page_name, page.page_user, page.page_date, users.id, users.user_name
                FROM page
                INNER JOIN users ON users.id = page.page_user
                WHERE page_name LIKE '%$arama%' LIMIT 28");
                $pageSQL->execute();

                $pageRow = $pageSQL->rowCount();
                if($pageRow <= 0) { echo '
                    <div class="SearchingMainCenter">
                        <p><b style="color: #C00;">'.$arama.'</b> &nbsp;bulunamadı !</p>
                    </div>
                ';
                    header('Refresh:2; url=searching.php');
                } else {
                    echo '<div class="SearchingMainCenter">';
                    foreach ($pageSQL as $pageView) {
                        echo '<div class="SearchingMainCenter-Line">';
                        echo '<a href="page-view.php?pageView=' . $pageView['PID'] . '"><p><i class="fa fa-binoculars"></i></p></a>
                        <p>' . mb_substr($pageView['page_name'], 0, 70, 'UTF-8') . '</p>
                        <p>' . mb_substr($pageView['user_name'], 0, 13, 'UTF-8') . '</p>
                        <p>' . $pageView['page_date'] . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            } elseif ($arama_secenek == 3) {
                $subpageSQL = $pdo->prepare("SELECT subpage.id as SubPID, subpage.subpage_name, subpage.subpage_user, subpage.subpage_date, users.id, users.user_name
                FROM subpage
                INNER JOIN users ON users.id = subpage.subpage_user
                WHERE subpage_name LIKE '%$arama%' LIMIT 28");
                $subpageSQL->execute();

                $subpageRow = $subpageSQL->rowCount();
                if($subpageRow <= 0) { echo '
                      <div class="SearchingMainCenter">
                        <p><b style="color: #C00;">'.$arama.'</b> &nbsp;bulunamadı !</p>
                      </div>
                ';
                    header('Refresh:2; url=searching.php');
                } else {
                    echo '<div class="SearchingMainCenter">';
                    foreach ($subpageSQL as $subpageView) {
                        echo '<div class="SearchingMainCenter-Line">';
                        echo '<a href="subpage-view.php?subPageView=' . $subpageView['SubPID'] . '"><p><i class="fa fa-binoculars"></i></p></a>
                        <p>' . mb_substr($subpageView['subpage_name'], 0, 70, 'UTF-8') . '</p>
                        <p>' . mb_substr($subpageView['user_name'], 0, 13, 'UTF-8') . '</p>
                        <p>' . $subpageView['subpage_date'] . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            } elseif ($arama_secenek == 4) {
                $categorySQL = $pdo->prepare("SELECT category.id as CID, category.category_name, category.category_user, category.category_date, users.id, users.user_name
                FROM category
                INNER JOIN users ON users.id = category.category_user
                WHERE category_name LIKE '%$arama%' LIMIT 28");
                $categorySQL->execute();

                $categoryRow = $categorySQL->rowCount();
                if($categoryRow <= 0) { echo '
                     <div class="SearchingMainCenter">
                        <p><b style="color: #C00;">'.$arama.'</b> &nbsp;bulunamadı !</p>
                     </div>
                ';
                    header('Refresh:2; url=searching.php');
                } else {
                    echo '<div class="SearchingMainCenter">';
                    foreach ($categorySQL as $categoryView) {
                        echo '<div class="SearchingMainCenter-Line">';
                        echo '<a href="category-view.php?categoryView=' . $categoryView['CID'] . '"><p><i class="fa fa-binoculars"></i></p></a>
                        <p>' . mb_substr($categoryView['category_name'], 0, 70, 'UTF-8') . '</p>
                        <p>' . mb_substr($categoryView['user_name'], 0, 13, 'UTF-8') . '</p>
                        <p>' . $categoryView['category_date'] . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            } elseif ($arama_secenek == 5) {
                $subcategorySQL = $pdo->prepare("SELECT subcategory.id as SubCID, subcategory.subcategory_name, subcategory.subcategory_user, subcategory.subcategory_date, users.id, users.user_name
                FROM subcategory
                INNER JOIN users ON users.id = subcategory.subcategory_user
                WHERE subcategory_name LIKE '%$arama%' LIMIT 28");
                $subcategorySQL->execute();

                $subcategoryRow = $subcategorySQL->rowCount();
                if($subcategoryRow <= 0) { echo '
                    <div class="SearchingMainCenter">
                        <p><b style="color: #C00;">'.$arama.'</b> &nbsp;bulunamadı !</p>
                    </div>
                ';
                    header('Refresh:2; url=searching.php');
                } else {
                    echo '<div class="SearchingMainCenter">';
                    foreach ($subcategorySQL as $subcategoryView) {
                        echo '<div class="SearchingMainCenter-Line">';
                        echo '<a href="subcategory-view.php?subcategoryView=' . $subcategoryView['SubCID'] . '"><p><i class="fa fa-binoculars"></i></p></a>
                        <p>' . mb_substr($subcategoryView['subcategory_name'], 0, 70, 'UTF-8') . '</p>
                        <p>' . mb_substr($subcategoryView['user_name'], 0, 13, 'UTF-8') . '</p>
                        <p>' . $subcategoryView['subcategory_date'] . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            } elseif ($arama_secenek == 6) {
                $noticeSQL = $pdo->prepare("SELECT notice.id as NID, notice.notice_name, notice.notice_user, notice.notice_date, users.id, users.user_name
                FROM notice
                INNER JOIN users ON users.id = notice.notice_user
                WHERE notice_name LIKE '%$arama%' LIMIT 28");
                $noticeSQL->execute();

                $noticeRow = $noticeSQL->rowCount();
                if($noticeRow <= 0) { echo '
                    <div class="SearchingMainCenter">
                        <p><b style="color: #C00;">'.$arama.'</b> &nbsp;bulunamadı !</p>
                    </div>
                ';
                    header('Refresh:2; url=searching.php');
                } else {
                    echo '<div class="SearchingMainCenter">';
                    foreach ($noticeSQL as $noticeView) {
                        echo '<div class="SearchingMainCenter-Line">';
                        echo '<a href="notice-view.php?noticeView=' . $noticeView['NID'] . '"><p><i class="fa fa-binoculars"></i></p></a>
                        <p>' . mb_substr($noticeView['notice_name'], 0, 70, 'UTF-8') . '</p>
                        <p>' . mb_substr($noticeView['user_name'], 0, 13, 'UTF-8') . '</p>
                        <p>' . $noticeView['notice_date'] . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            } elseif ($arama_secenek == 7) {
                $commentSQL = $pdo->prepare("SELECT comment.id as CoID, comment.comment, comment.ad_soyad, comment.comment_date
                FROM comment
                WHERE comment LIKE '%$arama%' LIMIT 28");
                $commentSQL->execute();

                $commentRow = $commentSQL->rowCount();
                if($commentRow <= 0) { echo '
                    <div class="SearchingMainCenter">
                        <p><b style="color: #C00;">'.$arama.'</b> &nbsp;bulunamadı !</p>
                    </div>
                ';
                    header('Refresh:2; url=searching.php');
                } else {
                    echo '<div class="SearchingMainCenter">';
                    foreach ($commentSQL as $commentView) {
                        echo '<div class="SearchingMainCenter-Line">';
                        echo '<a href="comment-view.php?commentView=' . $commentView['CoID'] . '"><p><i class="fa fa-binoculars"></i></p></a>
                        <p>' . mb_substr($commentView['comment'], 0, 70, 'UTF-8') . '</p>
                        <p>' . mb_substr($commentView['ad_soyad'], 0, 13, 'UTF-8') . '</p>
                        <p>' . $commentView['comment_date'] . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
        }

    }
?>
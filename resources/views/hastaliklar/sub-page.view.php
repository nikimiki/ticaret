<?php include_once HEADER; ?>
    <section>
        <div id="section">
            <ul id="hastaMenu">
                <li><a href="">Koroner Arter Hastalıkları</a></li>
                <li><a href="">Kalp Kapağı Hastalıkları</a></li>
                <li><a href="">Aort Hastalıkları</a></li>
                <li><a href="">Şah Damarı Tıkanıklığı</a></li>
                <li><a href="">Atar Damarı Tıkanıklıkları</a></li>
                <li><a href="">Atar Damar Genişlikleri</a></li>
                <li><a href="">Burger Hastalığı</a></li>
                <li><a href="">Raynoud Hastalığı</a></li>
                <li><a href="">Varis</a></li>
                <li><a href="">Derin Ven Trombozu</a></li>
            </ul>
            <article id="hastalikInf">
                <h3><?=$data['makale']->article_name;?></h3>
                <?=$data['makale']->article_info;?>
            </article>
        </div>
    </section>
    <footer>
        <?php include_once FOOTER_BIG; ?>
    </footer>

    <link rel="stylesheet" href="<?php echo BASE_ROOT; ?>public/css/hastaliklar.css"/>

<?php include_once FOOTER; ?>
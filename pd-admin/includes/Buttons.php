<?php
    function NavigatonButtons() {
        echo '
            <ul id="menu">
					<li><a href="main.php"><i class="fa fa-bar-chart"></i>Kontrol Paneli</a></li>
					<li>
						<a href="javascript:;"><i class="fa fa-file-o"></i>Sayfalar</a>
						<ul>
							<li><a href="pages.php"><i class="fa fa-file-o"></i>Sayfalar</a></li>
							<li><a href="page-add.php"><i class="fa fa-plus"></i>Sayfa Ekle</a></li>
							<li><a href="page-clean.php"><i class="fa fa-minus"></i>Sayfa Sil</a></li>
							<li><a href="page-change.php"><i class="fa fa-spinner"></i>Sayfa Değiştir</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-files-o"></i>Alt Sayfalar</a>
						<ul>
							<li><a href="subpages.php"><i class="fa fa-files-o"></i>Alt Sayfalar</a></li>
							<li><a href="subpage-add.php"><i class="fa fa-plus"></i>Alt Sayfa Ekle</a></li>
							<li><a href="subpage-clean.php"><i class="fa fa-minus"></i>Alt Sayfa Sil</a></li>
							<li><a href="subpage-change.php"><i class="fa fa-spinner"></i>Alt Sayfa Değiştir</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-folder-o"></i>Kategoriler</a>
						<ul>
							<li><a href="categorys.php"><i class="fa fa-folder-o"></i>Kategoriler</a></li>
							<li><a href="category-add.php"><i class="fa fa-plus"></i>Kategori Ekle</a></li>
							<li><a href="category-clean.php"><i class="fa fa-minus"></i>Kategori Sil</a></li>
							<li><a href="category-change.php"><i class="fa fa-spinner"></i>Kategori Değiştir</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-folder-open-o"></i>Alt Kategoriler</a>
						<ul>
							<li><a href="subcategorys.php"><i class="fa fa-folder-open-o"></i>Alt Kategoriler</a></li>
							<li><a href="subcategory-add.php"><i class="fa fa-plus"></i>Alt Kategori Ekle</a></li>
							<li><a href="subcategory-clean.php"><i class="fa fa-minus"></i>Alt Kategori Sil</a></li>
							<li><a href="subcategory-change.php"><i class="fa fa-spinner"></i>Alt Kategori Değiştir</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-pencil"></i>Yazılar</a>
						<ul>
							<li><a href="articles.php"><i class="fa fa-pencil"></i>Yazılar</a></li>
							<li><a href="article-add.php"><i class="fa fa-plus"></i>Yazı Ekle</a></li>
							<li><a href="article-clean.php"><i class="fa fa-minus"></i>Yazı Sil</a></li>
							<li><a href="article-change.php"><i class="fa fa-spinner"></i>Yazı Değiştir</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-picture-o"></i>Medya - Görsel</a>
						<ul>
							<li><a href="pictures.php"><i class="fa fa-picture-o"></i>Görseller</a></li>
							<li><a href="picture-add.php"><i class="fa fa-plus"></i>Görsel Ekle</a></li>
							<li><a href="picture-clean.php"><i class="fa fa-minus"></i>Görsel Sil</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-film" style="-webkit-transform: rotate(130deg);"></i>Medya - Video</a>
						<ul>
							<li><a href="videos.php"><i class="fa fa-film" style="-webkit-transform: rotate(130deg);"></i>Videolar</a></li>
							<li><a href="video-add.php"><i class="fa fa-plus"></i>Video Ekle</a></li>
							<li><a href="video-clean.php"><i class="fa fa-minus"></i>Video Sil</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-users"></i>Üyeler</a>
						<ul>
							<li><a href="users.php"><i class="fa fa-users"></i>Üyeler</a></li>
							<li><a href="user-add.php"><i class="fa fa-plus"></i>Üye Ekle</a></li>
							<li><a href="user-clean.php"><i class="fa fa-minus"></i>Üye Sil</a></li>
							<li><a href="user-change.php"><i class="fa fa-spinner"></i>Üye Değiştir</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-comments-o"></i>Yorumlar</a>
						<ul>
							<li><a href="comments.php"><i class="fa fa-comments-o"></i>Yorumlar</a></li>
							<li><a href="comment-clean.php"><i class="fa fa-minus"></i>Yorum Sil</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-bullhorn"></i>Duyurular</a>
						<ul>
							<li><a href="notices.php"><i class="fa fa-bullhorn"></i>Duyurular</a></li>
							<li><a href="notice-add.php"><i class="fa fa-plus"></i>Duyuru Ekle</a></li>
							<li><a href="notice-clean.php"><i class="fa fa-minus"></i>Duyuru Sil</a></li>
							<li><a href="notice-change.php"><i class="fa fa-spinner"></i>Duyuru Değiştir</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-film" style="-webkit-transform: rotate(90deg);"></i>Slider</a>
						<ul>
							<li><a href="slider.php"><i class="fa fa-film" style="-webkit-transform: rotate(90deg);"></i>Slider</a></li>
							<li><a href="slider-add.php"><i class="fa fa-plus"></i>Slider Ekle</a></li>
							<li><a href="slider-clean.php"><i class="fa fa-minus"></i>Slider Sil</a></li>
							<li><a href="slider-change.php"><i class="fa fa-spinner"></i>Slider Değiştir</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-envelope-o"></i>E-Mail Adresleri</a>
						<ul>
							<li><a href="e-mail.php"><i class="fa fa-envelope-o"></i>E-Mailler</a></li>
							<li><a href="e-mail-clean.php"><i class="fa fa-minus"></i>E-Mail Sil</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-phone"></i>İletişim</a>
						<ul>
							<li><a href="contacts.php"><i class="fa fa-phone"></i>İletişim</a></li>
							<li><a href="contact-add.php"><i class="fa fa-plus"></i>İletişim Ekle</a></li>
							<li><a href="contact-clean.php"><i class="fa fa-minus"></i>İletişim Sil</a></li>
							<li><a href="contact-change.php"><i class="fa fa-spinner"></i>İletişim Değiştir</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-calendar"></i>Muayene Talebi</a>
						<ul>
							<li><a href="muayene.php"><i class="fa fa-calendar"></i>Muayene</a></li>
							<li><a href="muayene-clean.php"><i class="fa fa-minus"></i>Muayene Sil</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-line-chart"></i>Foto Analiz</a>
						<ul>
							<li><a href="analiz.php"><i class="fa fa-line-chart"></i>Foto Analiz</a></li>
							<li><a href="analiz-clean.php"><i class="fa fa-minus"></i>Foto Analiz Sil</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:;"><i class="fa fa-question"></i>Soru Formu</a>
						<ul>
							<li><a href="soruform.php"><i class="fa fa-question"></i>Soru Formu</a></li>
							<li><a href="soruform-clean.php"><i class="fa fa-minus"></i>Soru Formu Sil</a></li>
						</ul>
					</li>
				</ul>
        ';
    }
?>
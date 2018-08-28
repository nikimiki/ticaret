<?php
    function SearchFull() {
        echo '
                <div class="SearchFull">
                    <form action="searching.php" method="post">
                        <div class="SearchIcon">
                            <button><i class="fa fa-search"></i></button>
                        </div>
                        <input type="text" name="arama" placeholder="Aramak istediğiniz kelimeyi yazınız..." />
					</form>
				</div>
        ';
    }
?>
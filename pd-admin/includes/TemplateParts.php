<?php

    include('Buttons.php');
    include('Search.php');
    include('Options.php');
    include('TotalinfoRight.php');


    function PartLeft() {
        NavigatonButtons();
    }
    function PartRight($pdo) {
        TotalInformationRight($pdo);
        SiteOfficer($pdo);
    }
    function SearchPart() {
        SearchFull();
    }
    function HeaderOptions($pdo) {
        HomeOptions($pdo);
        ProfilTab($pdo);
        AnotherOption();
    }

?>
<?php
    //opens countlog.txt to read the number of hits
    $datei = fopen("countlog.txt","r");
    $count = fgets($datei,1000);
    fclose($datei);
    $count=$count + 1;
    echo substr($count, 0, 18);
    echo " Giriş";
    echo "\n";

    // opens countlog.txt to change new hit number
    $datei = fopen("countlog.txt","w");
    fwrite($datei, $count);
    fclose($datei);
?>  
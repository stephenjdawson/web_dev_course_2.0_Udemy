<?
    include("11_includedFile.php"); //content from own server

    echo file_get_contents("https://www.ecowebhosting.co.uk"); //gets content on another site (in this case the html)
?>

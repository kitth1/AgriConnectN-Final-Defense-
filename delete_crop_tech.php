<?php

if ( isset($_GET["ID"])) {
    $ID = $_GET["ID"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "faccount";

                    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "DELETE FROM crop_list WHERE ID=$ID";
    $conn->query($sql);
}

header("location: tech_acc.php");
exit;
?>
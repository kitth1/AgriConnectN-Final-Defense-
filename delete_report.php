<?php

if ( isset($_GET["ID"])) {
    $ID = $_GET["ID"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "faccount";

                    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "DELETE FROM distribute WHERE ID=$ID";
    $conn->query($sql);
}

header("location: inventory.php");
exit;
?>
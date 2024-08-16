<?php
    $servername ="localhost";
    $username ="root";
    $password ="";
    $dbname ="breeders";

    $conn =new mysqli ($servername, $username, $password, $dbname);

    if ($conn->connect_error)
    {
        die ("Condition failed: " . $conn->connect_error);
    }
?>
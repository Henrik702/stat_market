<?php
// settings
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "stat_market";

try {
    $con = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_username, $db_password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

function resultToArray($result)
{
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

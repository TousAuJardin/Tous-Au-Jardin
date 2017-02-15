<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'devto790346';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db->query("SELECT distinct ville_nom FROM villes_france WHERE ville_nom LIKE '".$searchTerm."%' ORDER BY ville_nom ASC limit 5");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['ville_nom'];
}
//return json data
echo json_encode($data);
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");
$country = filter_input(INPUT_GET,"query", FILTER_SANITIZE_STRING);
$country_1 = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
$results = $country_1->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>

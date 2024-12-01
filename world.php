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
<!--<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul> -->

<?php if(isset($country)):?>
  <table class = "display">
      <caption><h2>ADDITIONAL COUNTRY INFORMATION<h2></caption>
    <thead>
      <tr>
          <th class = "mth1">Country Name</th>
          <th class = "mth2">Continent</th>
          <th class = "mth3">Year of Independence</th>
          <th class = "mth4">Head of State</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $country): ?>
          <tr>
            <td><?php echo $country["name"]; ?></td>
            <td><?php echo $country["continent"]; ?></td>
            <td><?php echo $country["independence_year"]; ?></td>
            <td><?php echo $country["head_of_state"]; ?></td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

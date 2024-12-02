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
$lookup = filter_input(INPUT_GET,"lookup", FILTER_SANITIZE_STRING);
$country_1 = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
$results = $country_1->fetchAll(PDO::FETCH_ASSOC);


$cities = $conn-> query("SELECT cities.name, cities.district, cities.population
FROM cities LEFT JOIN countries ON countries.code = cities.country_code
WHERE countries.name LIKE '%$country%'");
$city_results = $cities-> fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<!--<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul> -->

<?php if(isset($country)&&(!isset($lookup))):?>
  <table class = "display">
      <caption><h2>ADDITIONAL COUNTRY INFORMATION<h2></caption>
    <thead>
      <tr>
          <th class = "t1c1">Country Name</th>
          <th class = "t1c2">Continent</th>
          <th class = "t1c3">Year of Independence</th>
          <th class = "t1c4">Head of State</th>
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

<?php if (isset($lookup)):?>
  <table class = "display">
    <caption><h2>TABLE SHOWING CITIES FOR SAID COUNTRY</h2></caption>
    <thead>
      <tr>
        <th class = "t2c1">Name</th>
        <th class = "t2c2">District</th>
        <th class = "t2c3">Population</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($city_results as $lookup): ?>
        <tr>
          <td><?php echo $lookup["name"]; ?></td>
          <td><?php echo $lookup["district"]; ?></td>
          <td><?php echo $lookup["population"]; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif ?>

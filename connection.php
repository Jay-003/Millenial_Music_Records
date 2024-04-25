<?php

$username = "jmodi";
$server = "db.cs.dal.ca";
$password = "ovnrXJFuYpraMrWbqEdKjk8Sf";

try {

  $pdo = new PDO("mysql:host=db.cs.dal.ca;dbname=jmodi", $username, $password);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');

} catch (Exception $e) {

  echo 'Unable to connect to the database server.' . $e->getMessage();

  exit();
}

echo '<div style="position: fixed; top: 10px; right: 10px; width: 10px; height: 10px; background-color: green; border-radius: 50%;"></div>';

?>
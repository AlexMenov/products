
<a href="/">На главную страницу</a>

<?php

require_once "../vendor/autoload.php";
$new_db = $_POST["database_name"];
$new_table = $_POST["table_name"];

$db = new \App\Database\Database($new_db = "Products_db", $new_table = "Products");

$db->add_database();
$db->add_table();

?>



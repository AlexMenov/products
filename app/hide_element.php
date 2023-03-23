<?php

require_once "../vendor/autoload.php";

$db = new \App\CProducts\CProducts($new_db = "Products_db", $new_table = "Products");
$data = json_decode(file_get_contents("php://input"), true);
$hidden_id = $data['hidden_id'];
$db->hide_product($hidden_id);
$response = array('status' => 'success', 'message' => 'Element hidden successfully.');
header('Content-Type: application/json');
echo json_encode($response);
exit();





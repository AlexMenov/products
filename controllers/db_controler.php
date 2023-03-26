<?php
require_once "../vendor/autoload.php";
$db = new \App\Database\Database("stools");
$db->add_database();
$db->add_table("stools_collections");
$db->add_table("stools");


<?php

require_once "../vendor/autoload.php";

$st = new \App\CProducts\CProducts("stools", "stools_collections", "stools");

$st->create_collection(6, "КОЛЛЕКЦИЯ", "ТАБУРЕТКА");



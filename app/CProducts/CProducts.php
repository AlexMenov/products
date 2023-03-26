<?php

namespace App\CProducts;

class CProducts
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database;
    private $collection_table;
    private $stools_table;
    public $all_stools;
    public $all_collections;

    public function __construct($database_name, $collection_table, $stools_table)
    {
        $this->database = $database_name;
        $this->collection_table = $collection_table;
        $this->stools_table = $stools_table;
    }

    public function create_collection($collections_length, $collections_name, $products_name)
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        $count_stools_name = 1;
        for ($i = 1; $i <= $collections_length; $i++) {
            $collection_name = $collections_name . " " . $i;
            $collection_id = strval(mt_rand(100000, 99999999));
            $sql = "INSERT INTO `stools_collections` (`ID`, `COLLECTION_ID`, `COLLECTION_NAME`) VALUES (NULL, '$collection_id', '$collection_name')";
            echo !mysqli_query($conn, $sql) ? "Ошибка при создании коллекции: " . mysqli_error($conn) : "Создание коллекции '$collection_name' выполнено успешно </br>";
            for ($x = 1; $x <= $i + 1; $x++) {
                $this->create_stools($collection_id, $products_name, $conn, $count_stools_name);
                $count_stools_name++;
            }
        }
        mysqli_close($conn);
    }

    private function create_stools($collection_id, $products_name, $conn, $i)
    {
        $product_price = mt_rand(1000, 10000);
        $products_name = "$products_name $i";
        $sql = "INSERT INTO `stools` (`ID`, `COLLECTION_ID`, `PRODUCT_NAME`, `PRODUCT_PRICE`) VALUES (NULL, '$collection_id', '$products_name', '$product_price')";
        echo !mysqli_query($conn, $sql) ? "Ошибка при создании экземпляра товара : " . mysqli_error($conn) : "Создание товара '$products_name' выполнено успешно </br>";
    }

    public function get_all_stools()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        $sql = "SELECT * FROM $this->stools_table";
        $query = mysqli_query($conn, $sql);
        $this->all_stools = $query ? mysqli_fetch_all($query, MYSQLI_ASSOC) : false;
        mysqli_close($conn);
    }

    public function get_all_collections()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        $sql = "SELECT * FROM $this->collection_table";
        $query = mysqli_query($conn, $sql);
        $this->all_collections = $query ? mysqli_fetch_all($query, MYSQLI_ASSOC) : false;
        mysqli_close($conn);
    }
}
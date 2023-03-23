<?php

namespace App\CProducts;

class CProducts
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database;
    private $table;
    public $products;

    public function __construct($database_name, $table_name)
    {
        $this->database = $database_name;
        $this->table = $table_name;
    }

    public function get_all_products()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        $sql = "SELECT * FROM $this->table";
        $query = mysqli_query($conn, $sql);
        $this->products = $query ? mysqli_fetch_all($query, MYSQLI_ASSOC) : false;
        $this->products = $this->filter_by_hidden();
        $this->products = $this->sort_products();
        mysqli_close($conn);
    }

    public function slice_products()
    {

    }

    public function sort_products()
    {
        uasort($this->products, function ($item_one, $item_two) {
            $data = 'DATE_CREATE';
            $timestamp1 = strtotime($item_one[$data]);
            $timestamp2 = strtotime($item_two[$data]);
            return $timestamp1 < $timestamp2 ? 1 : ($timestamp1 > $timestamp2 ? -1 : 0);
        });
        return $this->products;
    }

    public function hide_product($id)
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        $sql = "UPDATE `Products` SET `HIDDEN` = '1' WHERE `Products`.`ID` = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: get_products.php");
    }

    private function filter_by_hidden()
    {
        return array_filter($this->products, function ($item) {
            return $item['HIDDEN'] == 0;
        });;
    }
}
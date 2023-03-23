<?php

namespace includes\Database;

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database;
    private $table;

    private function create_db()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password);
        if (!$conn) {
            die("Ошибка подключения: " . mysqli_connect_error());
        };
        $sql = "CREATE DATABASE " . $this->database;
        if (!mysqli_query($conn, $sql)) {
            echo "Ошибка при создании базы данных " . mysqli_error($conn);
        };
        mysqli_select_db($conn, $this->database);
        echo "Создание базы данных '$this->database' выполнено успешно";
    }

    private function create_table()
    {
        if ($this->table) {
            $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
            $sql = "CREATE TABLE `$this->database`.`$this->table` (`ID` INT(11) NOT NULL AUTO_INCREMENT , `PRODUCT_ID` INT(11) NOT NULL , `PRODUCT_NAME` VARCHAR(100) NOT NULL , `PRODUCT_PRICE` FLOAT(150) NOT NULL , `PRODUCT_ARTICLE` VARCHAR(300) NOT NULL , `PRODUCT_QUANTITY` INT(11) NOT NULL , `DATE_CREATE` DATE NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
            echo !mysqli_query($conn, $sql) ? "Ошибка при создании таблицы: " . mysqli_error($conn) : "Создание таблицы '$this->table' выполнено успешно";
        };
    }

    public function add_database($database_name = "products_db")
    {
        $this->database = $database_name;
        $this->create_db();
    }

    public function add_table($table_name = "products")
    {
        $this->table = $table_name;
        $this->create_table();
    }
}

;

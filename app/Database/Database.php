<?php

namespace App\Database;

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database;
    private $table;

    public function __construct($database_name, $table_name)
    {
        $this->database = $database_name;
        $this->table = $table_name;
    }

    private function create_db()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password);
        if (!$conn) {
            die("Ошибка подключения: " . mysqli_connect_error());
        };
        mysqli_set_charset($conn, "utf8");
        $sql = "CREATE DATABASE " . $this->database;
        if (!mysqli_query($conn, $sql)) {
            echo "Ошибка при создании базы данных " . mysqli_error($conn);
        };
        mysqli_select_db($conn, $this->database);
        echo "Создание базы данных '$this->database' выполнено успешно";
        mysqli_close($conn);
        header("/");
    }

    private function create_table()
    {
        if ($this->table) {
            $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
            mysqli_set_charset($conn, "utf8");
            $sql = "CREATE TABLE `$this->database`.`$this->table` (`ID` INT(11) NOT NULL AUTO_INCREMENT , `PRODUCT_ID` INT(11) NOT NULL , `PRODUCT_NAME` VARCHAR(100) NOT NULL , `PRODUCT_PRICE` FLOAT(10, 2) NOT NULL , `PRODUCT_ARTICLE` VARCHAR(300) NOT NULL , `PRODUCT_QUANTITY` INT(11) NOT NULL , `DATE_CREATE` DATE NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
            echo !mysqli_query($conn, $sql) ? "Ошибка при создании таблицы: " . mysqli_error($conn) : "Создание таблицы '$this->table' выполнено успешно";
            mysqli_close($conn);
        };
        header("/");
    }

    public function add_database()
    {
        $this->create_db();
    }

    public function add_table()
    {
        $this->create_table();
    }
}



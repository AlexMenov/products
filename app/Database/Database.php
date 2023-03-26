<?php

namespace App\Database;

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database;

    public function __construct($database_name)
    {
        $this->database = $database_name;
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

    private function create_table($new_table)
    {
        if ($new_table) {
            $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
            mysqli_set_charset($conn, "utf8");
            $sql = "CREATE TABLE `$this->database`.`$new_table` (`ID` INT(11) NOT NULL AUTO_INCREMENT , `COLLECTION_ID` INT(11) NOT NULL , `PRODUCT_NAME` VARCHAR(100) NOT NULL , `PRODUCT_PRICE` FLOAT(10, 2) NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
            if ($new_table === "stools_collections") {
                $sql = "CREATE TABLE `$this->database`.`$new_table` (`ID` INT(11) NOT NULL AUTO_INCREMENT , `COLLECTION_ID` INT(11) NOT NULL , `COLLECTION_NAME` VARCHAR(100) NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
            }
            echo !mysqli_query($conn, $sql) ? "Ошибка при создании таблицы: " . mysqli_error($conn) : "Создание таблицы '$this->table' выполнено успешно";
            mysqli_close($conn);
        };
        header("/");
    }

    public function add_database()
    {
        $this->create_db();
    }

    public function add_table($new_table)
    {
        $this->create_table($new_table);
    }
}



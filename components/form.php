

<head>
    <link rel="stylesheet" href="../css/style.css">
</head>

<div class="flex">
<div class="card-container">
    <div class="card pink small">
        <a href="/">Вернуться на главную</a>
    </div>
    <div class="card green small">
        <a href="catalog.php">Каталог товаров</a>
    </div>
</div>

<h1>Добро пожаловать!</h1>
<h2>Для создания БД / таблицы:</h2>
<form class="flex" action="/app/create_db_or_table.php" method="post">
    <label for="database_name">Укажите имя БД (по умолчанию "Products_db")</label>
    <input type="text" name="database_name" id="database_name">
    <label for="table_name">Укажите имя таблицы (по умолчанию "Products")</label>
    <input type="text" name="table_name" id="table_name">
    <input type="submit" value="Создать">
</form>

</div>
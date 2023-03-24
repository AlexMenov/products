<head>
    <link rel="stylesheet" href="../css/style.css"/>
</head>

<div class="flex">
    <div class="card-container">
        <div class="card pink small">
            <a href="/">Вернуться на главную</a>
        </div>
    </div>

    <form id="productForm">
        <label for="from">Показать товары с:
        <input type="number" id="from" name="from"></label>
        <label for="to">Показать товары по:
        <input type="number" id="to" name="to"></label>
        <button type="submit">Применить фильтры</button>
    </form>

    <?php require "../app/get_products.php"?>
</div>
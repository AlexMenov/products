<?php

require_once "../vendor/autoload.php";

$new_db = $_POST["database_name"];
$new_table = $_POST["table_name"];

$db = new \App\CProducts\CProducts($new_db = "Products_db", $new_table = "Products");
$start = min(intval($_GET['from']), 0);
$limit = intval($_GET['to']) ?: 10;
$db->get_all_products();
$all_products = $db->products;
$products_on_page = $db->slice_products($all_products, $start, $limit, true);
?>
    <div class="normal">
        <table>
            <thead>
            <tr>
                <th>Название</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Дата</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products_on_page as $item): {
                $id = 'ID';
                $p_id = 'PRODUCT_ID';
                $name = 'PRODUCT_NAME';
                $price = 'PRODUCT_PRICE';
                $article = 'PRODUCT_ARTICLE';
                $quantity = 'PRODUCT_QUANTITY';
                $data = 'DATE_CREATE';
                $create_date = date('d.m.Y', strtotime($item[$data]));
            }
                ?>
                <tr class='product-card hidden' id="<?= $item[$id] ?>">
                    <td class='product-name'><?php echo $item[$name]; ?></td>
                    <td class='product-description'><?php echo $item[$article]; ?></td>
                    <td class='product-price'><?php echo $item[$price]; ?> руб.</td>
                    <td class='product-quantity-plus'>+</td>
                    <td class='product-quantity'><?php echo $item[$quantity]; ?> шт.</td>
                    <td class='product-quantity-minus'>-</td>
                    <td class='product-date'><?php echo $create_date; ?></td>
                    <td class='product-link'>Скрыть</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


<?php require "script.php" ?>
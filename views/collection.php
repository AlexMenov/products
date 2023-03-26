<?php

require_once "../vendor/autoload.php";

$st = new \App\CProducts\CProducts("stools", "stools_collections", "stools");

$st->get_all_stools();
$st->get_all_collections();
$all_stools = $st->all_stools;
$all_collections = $st->all_collections;

$filtered_stools = array_filter($all_stools, function ($item) use ($all_collections) {
    return $item["COLLECTION_ID"] === $all_collections[5]["COLLECTION_ID"];
});

?>

<head>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div class="outer-container">
    <?php foreach ($all_collections as $collection): {
        $collection_name = 'COLLECTION_NAME';
        echo "<div class='inner-container'>
                 <div class='card'>
                 <p>Название: $collection[$collection_name]</p>
                 </div>";
        $filtered_stools = array_filter($all_stools, function ($item) use ($collection) {
            return $item["COLLECTION_ID"] === $collection["COLLECTION_ID"];
        });
    } ?>
    <?php
    foreach ($filtered_stools as $stool) {
        $name = 'PRODUCT_NAME';
        $price = 'PRODUCT_PRICE';
        echo "
                 <div class='card'>
                 <p>Название: $stool[$name]</p>
                 <p>Цена: $stool[$price]</p>
                 </div>
            ";
    }
    ?>
</div>
<?php endforeach; ?>
</div>
</body>
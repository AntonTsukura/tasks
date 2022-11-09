<?php
include __DIR__ . "/products_class.php";

$limit_index = 20;
$data = new CProducts();
$table = $data->controller_f($limit_index);
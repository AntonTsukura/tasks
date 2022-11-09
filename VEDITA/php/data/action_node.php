<?php
include __DIR__ . "/products_class.php";

$class_products = new CProducts();

$data = json_decode($_POST["data"]);
$id = $data->id;
$action = $data->action;
$response = array();

if($action == "hide_obj"){
    $class_products->hide_object($id);
    $response = array(
        "status" => "success",
        "body" => "Obj is hided"
    );
} else if($action == "add_product"){
    $class_products->add_unit($id);
    $response = array(
        "status" => "success",
        "body" => "Unit is added"
    );
} else if($action == "remove_product"){
    $is_removed = $class_products->remove_unit($id);
    if($is_removed == true){
        $response = array(
            "status" => "success",
            "body" => "Unit is removed"
        );
    } else {
        $response = array(
            "status" => "success",
            "body" => "Unit is not removed"
        );
    }

} else {
    $response = array(
        "status" => "failure",
        "body" => "Unknown action. E0002"
    );
}
echo json_encode($response);

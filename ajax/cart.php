<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/25/2018
 * Time: 3:27 PM
 */

if(!isset($_SESSION))
{
    session_start();
}

require_once __DIR__ . "/../db/db.php";
require_once __DIR__ . "/../utils/echojsonmessage.php";

$db = db::getInstance();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    if (isset($_COOKIE['product_cart'])) {
        $product_cards = json_decode($_COOKIE['product_cart']);
    }

    $total = 0;
    foreach ($product_cards as $product_card){
        $db->select_one("SELECT unit_price FROM product WHERE id = " . $product_card->product_id);
        $total += intval($db->getResult()->unit_price) * intval($product_card->quantity);
    }

    $status = (($_POST['payment'] == "2") ? "đã thanh toán" : "chưa thanh toán");
    if($db->insert("bill", [
        "customer_id" => $_SESSION['customer_login']['id'],
        "payment" => $_POST['payment'],
        "total" => $total,
        "status" => $status
    ])){
        $db->select_one("SELECT id FROM bill WHERE customer_id = " . $_SESSION['customer_login']['id']
            . " AND payment = " . $_POST['payment'] . " AND total = $total AND status = '$status'");
        $bill_id = $db->getResult()->id;
        foreach ($product_cards as $product_card){
           $db->insert("bill_detail", [
               "id_bill" => $bill_id,
               "id_product" => $product_card->product_id,
               "quantity" => $product_card->quantity,
           ]);
        }
        echo_success($bill_id);
    } else {
        echo_error("Thêm thất bại");
    }
}
<?php
/**
 * Created by Long
 * Date: 12/12/2018
 * Time: 9:46 PM
 */

require_once __DIR__ . "/../../db/db.php";

$db = db::getInstance();

if (!isset($_GET['type'])) return;

$start = (isset($_GET['start']) && is_numeric($_GET['start']) && intval($_GET['start']) >= 0) ? intval($_GET['start']) : 0;
$limit = (isset($_GET['limit']) && is_numeric($_GET['limit']) && intval($_GET['limit']) >= 0) ? intval($_GET['limit']) : 10;
$id = (isset($_GET['id']) && is_numeric($_GET['id']) && intval($_GET['id']) >= 0) ? intval($_GET['id']) : null;

header('Content-Type: application/json');

switch ($_GET['type']) {
    case "search":
        {
            $gender_array = ['Nam', 'Nữ', 'Khác'];

            $sqlTotal = "SELECT count(*) as total FROM customer WHERE ";
            $sql = "SELECT id, name, gender, email, address, phone, birthday, note, point, time_block 
                                  FROM customer WHERE ";
            $condition = "1";
            if ((isset($_GET['name']) && strlen($_GET['name']) > 0)) {
                $condition .= " AND name like '%" . db::validSql($_GET['name']) . "%'";
            }
            if ((isset($_GET['gender']) && in_array(ucfirst($_GET['gender']), $gender_array))) {
                $condition .= " AND gender = '" . db::validSql(ucfirst($_GET['gender'])) . "'";
            }
            if (isset($_GET['email']) && $_GET['email'] !== "") {
                $condition .= " AND email like '%" . db::validSql($_GET['email']) . "%'";
            }
            if ((isset($_GET['address']) && strlen($_GET['address']) > 0)) {
                $condition .= " AND address like '%" . db::validSql($_GET['address']) . "%'";
            }
            if (isset($_GET['phone']) && $_GET['phone'] != "") {
                if ((is_numeric($_GET['phone']) && strlen($_GET['phone']) > 3)) {
                    $condition .= " AND phone like '%" . db::validSql($_GET['phone']) . "%'";
                } else {
                    echo "null";
                    return;
                }
            }

            $sql .= $condition . " ORDER BY id ASC LIMIT {$start},{$limit}";
            $sqlTotal .= $condition;

            if ($db->select($sql)) {
                $response['data'] = $db->getResult();
                if ($db->select_one($sqlTotal)) {
                    $total = $db->getResult()->total;
                    if (is_numeric($total)) $response['total'] = intval($total);
                }
                echo json_encode($response);
                return;
            }
            echo "null";
            return;
        }

    case "remove":
        {
            if ($id == null) {
                echo "false";
                return;
            }

            if ($db->execute("DELETE FROM customer WHERE id = {$id}")) {
                echo "true";
                return;
            }

            echo "false";
            return;
        }
}
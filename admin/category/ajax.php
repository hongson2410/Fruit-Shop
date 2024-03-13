<?php
require_once("../../db/dbhelper.php");

if (!empty($_POST)) {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case ('deletecategory'):
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $sql = 'delete from category where category.id=' . $id;
                    execute($sql);
                }
                break;
            case ('deleteproduct'):
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $sql = 'delete from product where product.id=' . $id;
                    execute($sql);
                }
                break;
        }
    }
}

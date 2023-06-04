<?php
    require_once "method.php";
    $obj_mie = new Mie();
    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if (!empty($_GET["id"])) {
                $id = intval($_GET["id"]);
                $obj_mie->get_mie($id);
            } else {
                    $obj_mie->get_mies();
                }
            break;
        
        case 'POST':
            if (!empty($_GET["id"])) {
                $id = intval($_GET["id"]);
                $obj_mie->update_mie($id);
            } else {
                $obj_mie->insert_mie();
                }
            break;
            
        case 'DELETE':
            $id = intval($_GET["id"]);
            $obj_mie->delete_mie($id);
            break;

        default:
                header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
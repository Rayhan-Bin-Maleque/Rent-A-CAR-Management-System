<?php

session_start();

require_once "config/database.php";
require_once "config/functions.php";

$page=$_GET['page'] ?? 'auth';
$action=$_GET['action'] ?? 'login';

switch($page)
{
    case "auth":
        require_once "controllers/auth_controller.php";
        auth_controller($action);
        break;

    case "admin":
        require_once "controllers/admin_controller.php";
        admin_controller($action);
        break;

    case "manager":
        require_once "controllers/manager_controller.php";
        manager_controller($action);
        break;

    case "staff":
        require_once "controllers/staff_controller.php";
        staff_controller($action);
        break;

    case "customer":
        require_once "controllers/customer_controller.php";
        customer_controller($action);
        break;

    case "ajax":
        require_once "controllers/ajax_controller.php";
        ajax_controller($action);
        break;

    default:
        redirect("index.php?page=auth&action=login");
}

?>

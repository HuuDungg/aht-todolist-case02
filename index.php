<?php
require("./controller/AuthController.php");
require("./controller/TaskController.php");

$act = $_GET["act"] ?? "/";

$authController = new AuthController();
$taskController = new TaskController();

switch ($act) {
        // case for display
    case "register":
        $authController->register();
        break;
    case "login":
        $authController->login();
        break;
    case "logout":
        $authController->logout();
        break;
    case "list-task":
        $taskController->display();
        break;
    case "save-task":
        $taskController->save();
        break;
        // case for processing
    case "processing-login":
        $authController->processingLogin();
        break;
    case "processing-register":
        $authController->processingRegister();
        break;
    case "processing-add":
        $taskController->create();
        break;
    case "processing-edit":
        $taskController->edit();
        break;
    case "processing-delete":
        $taskController->delete();
        break;
    case "search":
        $taskController->search();
        break;
        //case deafault
    default:
        echo "404 - Page not found";
}

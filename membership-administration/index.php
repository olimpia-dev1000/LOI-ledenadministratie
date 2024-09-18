<?php
session_start();
include_once './model/database.php';
include_once './controller/UserController.php';
include_once './controller/FamilyController.php';
include_once './controller/MemberController.php';
include_once './controller/OptionsController.php';
include_once './controller/EntityController.php';
include_once './controller/ConfigurationController.php';
include_once './controller/ContributionController.php';
include_once './controller/HomeController.php';
include_once 'functions.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$urlSegments = explode('/', trim($url, '/'));

$action = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true ? (!empty($urlSegments[1]) ? $urlSegments[1] : 'home') : 'user';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    UserController::checkIpAddress();
    UserController::sessionRegenaration();
}
switch ($action) {
    case 'home':
        $homeController = (new HomeController())->index();
        break;
    case 'family':
        handleAction(
            'FamilyController',
            'family',
            'family',
            [
                'add' => ['method' => 'add'],
                'delete' => ['method' => 'delete', 'param' => 'family_id'],
                'edit' => ['method' => 'show', 'param' => 'family_id'],
                'save-changes' => ['method' => 'edit'],
                'show-family' => ['method' => 'showById', 'param' => 'family_id', 'column' => 'family_id'],
            ]
        );
        break;
    case 'member':
        handleAction(
            'MemberController',
            'family_member',
            'family_member',
            [
                'add' => ['method' => 'add'],
                'delete' => ['method' => 'delete', 'param' => 'family_member_id'],
                'edit' => ['method' => 'show', 'param' => 'family_member_id'],
                'save-changes' => ['method' => 'edit'],
                'show-members' => ['method' => 'showById', 'param' => 'family_id', 'column' => 'family_id'],
            ]
        );
        break;
    case 'user':
        handleAction(
            'UserController',
            'user',
            'user',
            [
                'add' => ['method' => 'addUser'],
                'delete' => ['method' => 'delete', 'param' => 'user_id'],
                'edit' => ['method' => 'show', 'param' => 'user_id'],
                'save-changes' => ['method' => 'editUser'],
                'logout' => ['method' => 'logoutUser'],
                'login' => ['method' => 'loginUser']
            ]
        );
        break;
    case 'contribution':
        $allowed = isset($_SESSION['role']) && in_array($_SESSION['role'], ['admin', 'treasurer']);
        $allowed ? handleAction('ContributionController', 'contribution', 'contribution', [
            'add' => ['method' => 'add'],
            'delete' => ['method' => 'delete', 'param' => 'contribution_id'],
            'edit' => ['method' => 'show', 'param' => 'contribution_id'],
            'save-changes' => ['method' => 'edit'],
        ]) : include('view/404.php');
        break;
    case 'configuration':
        $allowed = isset($_SESSION['role']) && in_array($_SESSION['role'], ['admin', 'treasurer']);
        $allowed ? handleAction('ConfigurationController', $_POST['options_entity'] ?? '', 'configuration', [
            'add' => ['method' => 'add'],
            'delete' => ['method' => 'delete', 'param' => 'configuration_entity_id'],
            'edit' => ['method' => 'show', 'param' => 'configuration_entity_id'],
            'save-changes' => ['method' => 'edit'],
        ]) : include('view/404.php');
        break;
    default:
        include('view/404.php');
        break;
}

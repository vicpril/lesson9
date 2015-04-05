<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

$project_root = $_SERVER['DOCUMENT_ROOT'];
$smarty_dir = $project_root . '/smarty/';
$mysql_dir = $project_root;

// put full path to Smarty.class.php
require($smarty_dir . '/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = false;

$smarty->template_dir = $smarty_dir . 'templates';
$smarty->compile_dir = $smarty_dir . 'templates_c';
$smarty->cache_dir = $smarty_dir . 'cache';
$smarty->config_dir = $smarty_dir . 'configs';

require($mysql_dir . '/mysql.php');

// Functions
function getListOfExplanations($explanations) {
    $list = array();
    foreach ($explanations as $key => $value) {
        $list[] = '<a href="index.php?show=' . $key . '">' . $value['title'] . '</a>';
        $list[] = $value['price'];
        $list[] = $value['seller_name'];
        $list[] = '<a href="index.php?delete=' . $key . '">Удалить</a>';
    }
    return $list;
}

function processingQuery($array) {
    foreach ($array as $key => &$value) {
        $query[$key] = trim(htmlspecialchars($value), ' .,\|/*-+');
    }
    $query['price'] = (float) $query['price'];
    return $query;
}

// Main block

$explanations = get_explanations_from_db();

$cities = getCitiesList();
$categories = getCategoriesList();

if (isset($_GET['show']) && isset($explanations[$_GET['show']])) {
    $show = $_GET['show'];
    $name = $explanations[$show];
    $smarty->assign('header_tpl', 'header_exp');
    $smarty->assign('title', 'Объявление');
    $smarty->assign('show', $show);
    $smarty->assign('name', $name);
} else {
    $smarty->assign('header_tpl', 'header');
    $smarty->assign('title', 'Доска объявлений');
}
$id = (isset($_GET['id'])) ? $_GET['id'] : '';

if (isset($_GET['delete'])) {
    delete_explanation_from_db($_GET['delete']);
    $explanations = get_explanations_from_db();
}

if (isset($_POST['button_add'])) {
    $ads = processingQuery($_POST);
    add_explanation_into_db($ads, $id);
    $explanations = get_explanations_from_db();
}

$listOfExplanations = getListOfExplanations($explanations);

$smarty->assign('private_radios', array('0' => 'Частное лицо', '1' => 'Компания'));
$smarty->assign('cities', $cities);
$smarty->assign('categories', $categories);
$smarty->assign('list', $listOfExplanations);
$smarty->assign('tr', array('bgcolor="#ffffff"', 'bgcolor="#E7F5FE"'));

$smarty->display('index.tpl');
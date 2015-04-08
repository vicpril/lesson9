<?php
error_reporting(E_ALL);
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

function parceDump ($dump_filename, $i = 0, $j = 0) {
    $dump = file($dump_filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($dump as $key => $value) {
        if (substr($value, 0,2) == '--') {
            unset($dump[$key]);
        }
    }
    $str = implode('', $dump);
    $str = htmlspecialchars_decode($str);
    while ($i<=strlen($str)-1) {
        if ($str[$i] == ';') {
            $query = substr($str, $j, $i-$j);
            mysql_query($query) or die("<br>Не удалось выполнить запрос ". mysql_error());
            $j = $i+1;
        }
        $i++;
    }
}

if (isset($_POST['button_install'])) {
    $database_name = $_POST['database_name'];
    $server_name = $_POST['server_name'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    
    $project_root = $_SERVER['DOCUMENT_ROOT'];
    $dump_dir = $project_root . '/dump_db/';
    $filename = $dump_dir . 'test.sql';

    $db = mysql_connect($server_name, $user_name, $password)
            or die('MySQL сервер недоступен ' . mysql_error());
    mysql_query("SET NAMES utf8");

    mysql_select_db($database_name, $db) or die('Не удолось выбрать БД ' . mysql_error());

    if (!file_exists($filename)) {
        exit('Дамп базы не найден');
    }
    if (!file($filename)) {
        exit('Ошибка: неверный формат файла ' . $filename);
    } else {
        parceDump($filename);
    }
    
    $smarty->assign('server_name', $server_name);
    $smarty->assign('database_name', $database_name);
    $smarty->assign('user_name', $user_name);
    $smarty->assign('password', $password);
    
    $smarty->display('install_ok.tpl');
} else {
    $smarty->display('install.tpl');
}



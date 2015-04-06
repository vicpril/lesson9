<?php
error_reporting(E_ERROR);
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

function parceQuery ($str, $i, $j) {
    while ($i<=strlen($str)) {
        if ($str[$i] == ';' && substr($str, $i-5, 6) !== '&quot;') {
            $query = substr($str, $j, $i-$j+1);
            mysql_query($query) or die("<br>Не удалось выполнить запрос ". mysql_error());
            $j = $i+1;
        }
        $i++;
    }
}

if (isset($_POST['button_install'])) {
    $project_root = $_SERVER['DOCUMENT_ROOT'];
    $dump_dir = $project_root . '/dump_db/';
    $filename = $dump_dir . 'lesson_9.sql';

    $db = mysql_connect($_POST['server_name'], $_POST['user_name'], $_POST['password'])
            or die('MySQL сервер недоступен ' . mysql_error());
    mysql_query("SET NAMES utf8");

    mysql_select_db($_POST['database_name'], $db) or die('Не удолось выбрать БД ' . mysql_error());

    if (!file_exists($filename)) {
        exit('Дамп базы не найден');
    }
    if (!file_get_contents($filename)) {
        exit('Ошибка: неверный формат файла ' . $filename);
    } else {
        $query = file_get_contents($filename);
    }
    parceQuery($query, 0, 0);
    
    $smarty->display('install_ok.tpl');
} else {
    $smarty->display('install.tpl');
}



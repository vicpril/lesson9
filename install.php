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

function dropOldTables($db) {
    mysql_query("SET FOREIGN_KEY_CHECKS = 0");
    $query = mysql_query("SELECT concat('DROP TABLE IF EXISTS ', table_name, ';') AS `drop` "
                        ."FROM information_schema.tables "
                        ."WHERE table_schema = '$db'") or die (mysql_error());
    
    while ($row = mysql_fetch_assoc($query)){
        mysql_query($row['drop']) or die (mysql_error());
    }
    mysql_query("SET FOREIGN_KEY_CHECKS = 1");
}

function parceDump ($dump_filename, $i = 0, $j = 0) {
    $dump = file($dump_filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($dump as $key => $value) {
        if (substr($value, 0,2) == '--') {
            unset($dump[$key]);
        }
    }
    $str = implode('', $dump);
//    $str = htmlspecialchars_decode($str);
    while ($i<=strlen($str)-1) {
        if ($str[$i] == ';') {
            $query = substr($str, $j, $i-$j);
            mysql_query($query) or die("<br>Не удалось выполнить запрос ". mysql_error());
            $j = $i+1;
        }
        $i++;
    }
}

//
// Main block
//

if (isset($_POST['button_install'])) {
    include ($mysql_dir.'/mysql.php');
    
    $user = db_connect($smarty);
    
    $dump_dir = $project_root . '/dump_db/';
    $filename = $dump_dir . 'test.sql';
    
    if (!file_exists($filename)) {
        exit('Дамп базы не найден');
    }
    if (!file($filename)) {
        exit('Ошибка: неверный формат файла ' . $filename);
    } else {
        dropOldTables($user['db_name']);
        parceDump($filename);
    }
    
    $smarty->display('install_ok.tpl');
} else {
    $smarty->assign('title', 'Install dump DB');
    $smarty->assign('action','install.php');
    $smarty->display('install.tpl');
}



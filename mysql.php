<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

$server_name = (isset($_POST['server_name'])) ? $_POST['server_name'] : 'localhost'; 
$database_name = (isset($_POST['database_name'])) ? $_POST['database_name'] : 'test'; 
$user_name = (isset($_POST['user_name'])) ? $_POST['user_name'] : 'test'; 
$password = (isset($_POST['password'])) ? $_POST['password'] : '123'; 

$db = mysql_connect($server_name, $user_name, $password) or die ('MySQL сервер недоступен '. mysql_error());
mysql_query("SET NAMES utf8");

//echo 'Соединение с БД установлено';

mysql_select_db($database_name, $db) or die('Не удолось выбрать БД '. mysql_error());

//echo ' БД выбрана';

function getCitiesList () {
    $query = mysql_query("SELECT * FROM cities_list");
    while ($row = mysql_fetch_assoc($query)) {
        $cities [$row['index']] = $row['city'];
    }
    return $cities;
}

function getCategoriesList() {
    $query = mysql_query("SELECT t2.index, t2.category AS cat, t1.category AS groupe
                        FROM categories_list AS t1
                        LEFT JOIN categories_list AS t2 ON t2.parent_id = t1.index
                        WHERE t2.parent_id is not null");
    while ($row = mysql_fetch_assoc($query)) {
        $categories [$row['groupe']][$row['index']] = $row['cat'];
    }
    return $categories;
}

function get_explanations_from_db() {
    $query = mysql_query("SELECT * FROM explanations");
    while ($row = mysql_fetch_assoc($query) ) {
        $explanations[$row['id']] = $row;
    }
    if (isset($explanations)) {
        return $explanations;
    } else {
        return array();
    }
}

function add_explanation_into_db($exp, $id) {
    mysql_query("REPLACE INTO explanations (`id`, `private`, `seller_name`, `email`, `allow_mails`, `phone`, `location_id`, `category_id`, `title`, `description`, `price`)
                VALUES ('".$id."', '".$exp['private']."', '".$exp['seller_name']."' , '".$exp['email']."', '".$exp['allow_mails']."', '"
                .$exp['phone']."', '".$exp['location_id']."', '".$exp['category_id']."', '".$exp['title']."', '"
                .$exp['description']."', '".$exp['price']."')") or die("REPLACE abort ".mysql_error());
}

function delete_explanation_from_db($id) {
    mysql_query("delete from explanations where id = $id") or die("Не удалось удалить объявление".mysql_error());
}


// заполнение таблиц городов и категорий в БД
// 
//$cities = array('641780' => 'Новосибирск', '641490' => 'Барабинск', '641510' => 'Бердск', '641600' => 'Искитим', '641630' => 'Колывань', '641680' => 'Краснообск', '641710' => 'Куйбышев', '641760' => 'Мошково', '641790' => 'Обь', '641800' => 'Ордынское', '641970' => 'Черепаново',);
//
//$categories = array(
//    'Транспорт' => array('9' => 'Автомобили с пробегом', '109' => 'Новые автомобили', '14' => 'Мотоциклы и мототехника', '81' => 'Грузовики и спецтехника', '11' => 'Водный транспорт', '10' => 'Запчасти и аксессуары'),
//    'Недвижимость' => array('24' => 'Квартиры', '23' => 'Комнаты', '25' => 'Дома, дачи, коттеджи', '26' => 'Земельные участки', '85' => 'Гаражи и машиноместа', '42' => 'Коммерческая недвижимость', '86' => 'Недвижимость за рубежом'),
//    'Работа' => array('111' => 'Вакансии (поиск сотрудников)', '112' => 'Резюме (поиск работы)'),
//    'Услуги' => array('114' => 'Предложения услуг', '115' => 'Запросы на услуги'),
//    'Личные вещи' => array('27' => 'Одежда, обувь, аксессуары', '29' => 'Детская одежда и обувь', '30' => 'Товары для детей и игрушки', '28' => 'Часы и украшения', '88' => 'Красота и здоровье'),
//    'Для дома и дачи' => array('21' => 'Бытовая техника', '20' => 'Мебель и интерьер', '87' => 'Посуда и товары для кухни', '82' => 'Продукты питания', '19' => 'Ремонт и строительство', '106' => 'Растения'),
//    'Бытовая техника' => array('32' => 'Аудио и видео', '97' => 'Игры, приставки и программы', '31' => 'Настольные компьютеры', '98' => 'Ноутбуки', '99' => 'Оргтехника и расходники', '96' => 'Планшеты и электронные книги', '84' => 'Телефоны', '101' => 'Товары для компьютера', '105' => 'Фототехника'),
//    'Хобби и отдых' => array('33' => 'Билеты и путешествия', '34' => 'Велосипеды', '83' => 'Книги и журналы', '36' => 'Коллекционирование', '38' => 'Музыкальные инструменты', '102' => 'Охота и рыбалка', '39' => 'Спорт и отдых', '103' => 'Знакомства'),
//    'Животные' => array('89' => 'Собаки', '90' => 'Кошки', '91' => 'Птицы', '92' => 'Аквариум', '93' => 'Другие животные', '94' => 'Товары для животных'),
//    'Для бизнеса' => array('116' => 'Готовый бизнес', '40' => 'Оборудование для бизнеса'));
//
//$i=0;
//$group = array_keys($categories);
//for ($i=0 ; $i < count($categories); $i++) {
//    
//    $query = "REPLACE INTO category_group (`category_id`, `name`)"
//            . "VALUES (1000+$i, '$group[$i]')";
//    mysql_query($query) or die ("Error query ".mysql_error());
//    
//}

//foreach ($categories as $group => $value) {
//    foreach ($value as $key => $cat) {
//        $insert_sq = "INSERT INTO `categories_list` (`index`, `category`, `group`) "
//                . "VALUES ('$key', '$cat', '$group')";
//        mysql_query($insert_sq) or die ("<br>Запись не добалена". mysql_error());
//        echo "<br>Запись добавлена $key -> $cat -> $group";
//    }
//}
//
//foreach ($cities as $key => $value) {
//    $insert_sq = "INSERT INTO `cities_list` (`index`, `city`) VALUES ('$key', '$value')";
//    mysql_query($insert_sq) or die ("<br>Запись не добалена". mysql_error());
//    echo "<br>Запись $key -> $value добавлена";
//}
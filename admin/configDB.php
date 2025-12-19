<?php
define("HOST", "localhost");
define("USER", "root");
define("PWD", "");
define("DB", "db_great_museums");
define("ROOT", $_SERVER['DOCUMENT_ROOT']);

// =============================================
// ФУНКЦИЯ ДЛЯ ВЫБОРА СТРАНИЦЫ
// =============================================
function getPageSelect($page = '') {
    $pages = [
        'articles' => 'Статьи',
        'cities' => 'Города', 
        'great' => 'Великие музеи',
        'painting' => 'Живопись',
        'sculpture' => 'Скульптура'
    ];
    
    $select = '<select name="page">';
    foreach ($pages as $key => $value) {
        $selected = ($key == $page) ? 'selected' : '';
        $select .= "<option value='$key' $selected>$value</option>";
    }
    $select .= '</select>';
    
    return $select;
}
?>
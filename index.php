<?php

//подключаем библиотеки
require_once('curl/curl.php');
require_once('phpquery/phpQuery/phpQuery.php');

//объект Curl
$curl = new Curl();
//запрос
$query = 'холодильники';
//ответ
$response = $curl->get('http://price.ua/search/?q=' . $query);

/**
//проверка
var_dump($response->body);
*/

//подключаем
$doc = phpQuery::newDocument($response->body);

//находим все товары на странице
$products = $doc->find('.product-item .product-item');

//выводим загаловок товара
foreach($products as $product){
    $pq = pq($product);
    echo $pq->find('.model-name.clearer-block')->text().'<br>';
    echo $pq->find('a.price')->text().'<br>';
    echo '-----------------------------------------------<br>';
}

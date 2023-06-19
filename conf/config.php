<?php

    // API для отправки запроса и токен бота
    define('API_TELGRAM', 'https://api.telegram.org/bot');
    define('TOKEN', 'Your Token');

    // API для получения занятия
    define('API_BORED','http://www.boredapi.com/api/activity/');

    // DB
    define('HOST_DB', 'localhost'); 
    define('USER_DB', 'root');
    define('PASS_DB', '');
    define('NAME_DB', '');
    $link = mysqli_connect(HOST_DB, USER_DB, PASS_DB, NAME_DB);

    // Сегодняшняя дата и время
    $today = date('d.m.y');
    $time_now = date('h:i:s');

    // Поступающие запросы, декодирование полученного запроса в массив, проверка ключа
    $accept = file_get_contents('php://input');
    $accept_decode = json_decode($accept, TRUE);

    // Записываем все, что получаем от Telegram
    if($accept != false){
        file_put_contents('./receiving/rec '.$today.' '.'.txt',"$accept\n\n\n",FILE_APPEND);
    };

    // Данные пользователя отправившего запрос
    if(array_key_exists('message', $accept_decode)){
        $accept_key_message = true;
        $user_data = $accept_decode['message']['from'];
        $user_id = $accept_decode['message']['from']['id'];
        $user_name = $accept_decode['message']['from']['username'];
        $user_fname = $accept_decode['message']['from']['first_name'];
        $text_decode = $accept_decode['message']['text'];
        $text = strtolower($text_decode);
        $time = date('H:i:s', $accept_decode['message']['date']);
    }else if(array_key_exists('callback_query', $accept_decode)){
        $accept_key_callback = true;
        $user_id = $accept_decode['callback_query']['from']['id'];
        $user_name = $accept_decode['callback_query']['from']['username'];
        $user_fname = $accept_decode['callback_query']['from']['first_name'];
        $text_decode = $accept_decode['callback_query']['data'];
        $text = strtolower($text_decode);
        $time = date('H:i:s', $accept_decode['callback_query']['message']['date']);
    };
    

    // Подключаем нужный скрипт
    include_once './back/receiving.php';

    // Формирование данных для отправки пользователю
    $chat = $chat_id;
    $message = $result;

    if($text == 'Привет'){
        $rep_mar = json_encode(array(
            'keyboard' => array(
                array(
                    array(
                        'text' => 'Рецепт'
                    ),
                    array(
                        'text' => 'Помощь',
                    ),
                )
            ),
            'resize_keyboard' => TRUE,
            'one_time_keyboard' => TRUE,
        ));
    }else if($text == 'Пока'){
        $rep_mar = json_encode(array(
            'keyboard' => array(
                array(
                    array(
                        'text' => 'Пока'
                    ),
                    array(
                        'text' => 'Помощь',
                    ),
                )
            ),
            'resize_keyboard' => TRUE,
            'one_time_keyboard' => false,
        ));
    };
    
    $param = [
        'chat_id' => $chat,
        'text' => $message,
        'parse_mode' => 'html',
        'reply_markup' => $reply_markup_json
    ];

?>
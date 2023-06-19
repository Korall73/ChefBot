<?php

    include_once 'config.php'; // Переменные

    // Отправка запроса в Telegram
    function request(){
        global $param, $method;

        if(is_array($param) && !empty($param)){
            $ch = curl_init(API_TELGRAM.TOKEN.'/'.$method.'?'.http_build_query($param));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $result_curl = curl_exec($ch);
            echo $result_curl;
            curl_close($ch);
        }else{
            return;
        };
        
    };

    //История полученных и отправленных сообщений
    function log_user(){
        global $accept_key_message, $user_data, $today, $time, $text, $time_now, $result;

        if($accept_key_message == true){
            file_put_contents('./logs/user '.$user_data['id'].' '.$user_data['username'].' '.$today.'.txt',
            print_r('('.$time.') '.$user_data['first_name'].' '.$user_data['username'].': '.$text."\n".
            '('.$time_now.') Туганхан: '.$result."\n", 1), FILE_APPEND);
        }else{
            return;
        };
    };

    // Проверяем, новый ли пользователь нам написал. Если нет то заносим его данные в БД

    function new_user(){
        global $accept_key_message, $link, $user_id, $user_name, $user_fname, $today, $param, $method, $chat_id, $result;

        $select = "SELECT EXISTS(SELECT * FROM `users_private` WHERE `id_tg` = '$user_id')";
        $insert = "INSERT INTO `users_private`(`id_tg`, `user_name`, `first_name`, `registered`)
                VALUES('$user_id', '$user_name', '$user_fname', '$today')";
        
        if($accept_key_message == true){
            if($link == true){
                $select_sql = mysqli_fetch_all(mysqli_query($link, $select));

                if($select_sql[0][0] == 0){
                    mysqli_query($link, $insert);
                };
                mysqli_close($link);
            };
        };
    };

    // Обрабатываем полученную команду и запускаем нужный скрипт
    function receiving(){
        global $accept_key_message, $text, $result, $link, $user_id, $chat_id, $accept_decode, $method, $param,
        $reply_markup_json;
        $strpos = mb_strpos($text, 'Напиши');
        $strpos_debug = mb_strpos($text, 'Отладка');

        if($user_id == 1042133777){
            if($link == true){
                $debug_admin = "SELECT `debug` FROM `admin_bot` WHERE `id_tg` = '$user_id'";
                $debug_admin_sql = mysqli_fetch_array(mysqli_query($link, $debug_admin));
                if($debug_admin_sql['debug'] == 'debug'){
                    include_once './debugging/receiv_debug.php';
                    mysqli_close($link);
                }else{
                    $method = 'sendMessage';
                    $chat_id = $accept_decode['message']['chat']['id'];
                    $result = "Все нормально";
                    include_once './back/request.php';
                };
            };
        };

        if($accept_key_message == true){
            if($text == 'Скучно'){
                include_once './commands/bored.php';
            }else if($text == 'Рецепт'){
                include_once './commands/recipe/recipe.php';
            }else if($text == 'Работаешь?'){
                $method = 'sendMessage';
                $chat_id = $accept_decode['message']['chat']['id'];
                $result = 'Да';
            }else if($text == '/start'){
                include_once './commands/start.php';
            }else if($text == 'Помощь'){
                include_once './commands/help.php';
            }else if($strpos !== false){
                include_once './commands/message/message_dev.php';
            }else if($strpos_debug !== false){
                include_once './commands/debug_message/debug.php';
            }else{
                $method = 'sendMessage';
                $chat_id = $accept_decode['message']['chat']['id'];
                $result = "Неизвестная команда!";
            };
        }else if($accept_key_callback == true && $link == true){
            if(
                $text == 'Алкоголь' ||
                $text == 'Закуски' ||
                $text == 'Основное' ||
                $text == 'Десерты' ||
                $text == 'Торты' ||
                $text == 'Снеки' ||
                $text == 'Салаты' ||
                $text == 'Супы'
            )
            {
                include_once './commands/recipe/callback.php';
                mysqli_close($link);
            }else{
                $method = 'sendMessage';
                $chat_id = $accept_decode['callback_query']['message']['chat']['id'];
                $result = "Неизвестная команда!";
            };
        };
    };

?>
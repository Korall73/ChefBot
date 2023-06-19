<?php

    if($link == true){
        include_once './commands/debug_message/config_debug.php';
        
        if($access_sql['debug'] == '1'){
            if($mes_str == ' вкл'){
                $value_debug = 'debug';
                $method = 'sendMessage';
                $chat_id = $accept_decode['message']['chat']['id'];
                $result = 'Отладка включена';
            }else if($mes_str == 'выкл'){
                $value_debug = 'public';
                $method = 'sendMessage';
                $chat_id = $accept_decode['message']['chat']['id'];
                $result = 'Отладка выключена';
            };
            mysqli_query($link, $debug_req);
        }else{
            $method = 'sendMessage';
            $chat_id = $accept_decode['message']['chat']['id'];
            $result = 'Неизвестная команда! debug не 1';
        };
        mysqli_close($link);
    }else{
        $method = 'sendMessage';
        $chat_id = $accept_decode['message']['chat']['id'];
        $result = 'Неизвестная команда! Нет подключения';
    };

?>
<?php

    if($link == true){
        include_once './commands/message/config_message.php';

        if($exists_sql[0][0] == 1){
            if($access_sql[0][0] == 1 || $access_sql[0][0] == 2){
                if($mode_sql[0][0] == NULL){
                    if($mes_id !== false){
                        mysqli_query($link, "UPDATE `admin_bot` SET `mode` = 1, `user_id` = '$mes_id'");
                        $chat_id = $accept_decode['message']['chat']['id'];
                        $result = "Введите сообщение по следующей форме:\n\n'Напиши <i>сообщение пользователю</i>'";
                        $method = 'sendMessage';
                    }else{
                        $chat_id = $accept_decode['message']['chat']['id'];
                        $result = "Введите команду по следующей форме:\n\n'Напиши <i>id пользователя</i>'";
                        $method = 'sendMessage';
                    };
                };
                if($mode_sql[0][0] == 1){
                    if($mes_id !== false && $admin_user_id_sql[0][0] != 101){
                        $chat_id = $admin_user_id_sql[0][0];
                        $result = $mes_id;
                        $method = 'sendMessage';
                    };
                    if($mes_id !== false && $admin_user_id_sql[0][0] == 101){
                        $num_rows = mysqli_num_rows(mysqli_query($link, 'SELECT `id` FROM `users_private`'));
                        $i = 0;
                        while($i < $num_rows){
                            $row = $select_users_id_sql;
                            $param = [
                                'chat_id' => $row[$i][0],
                                'text' => $mes_id,
                                'parse_mode' => 'html'
                            ];
                            $method = 'sendMessage';
                            file_get_contents(API_TELGRAM.TOKEN.'/'.$method.'?'.http_build_query($param));
                            $i++;
                        };
                        $method = 'sendMessage';
                        $chat_id = $accept_decode['message']['chat']['id'];
                        $result = 'Собщение доставлено всем пользователям!';
                    };
                    mysqli_query($link, "UPDATE `admin_bot` SET `mode` = NULL, `user_id` = NULL");
                };
            }else{
                $chat_id = $accept_decode['message']['chat']['id'];
                $result = 'У вас нет доступа к данной команде! Запросите доступ у @Korall73.';
                $method = 'sendMessage';
            };
        }else{
            $chat_id = $accept_decode['message']['chat']['id'];
            $result = 'Неизвестная команда!';
            $method = 'sendMessage';
        };

        mysqli_close($link);
    }else{
        $chat_id = 1042133777;
        $result = 'Не удалось отправить сообщение';
        $method = 'sendMessage';
    };

?>
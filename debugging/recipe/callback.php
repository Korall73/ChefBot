<?php

    $sql = "SELECT `id` FROM `recipest` WHERE `sort` = $text";
    $num_rows = mysqli_num_rows(mysqli_query($link, $sql));

    if($num_rows > 0){
        $id_array = [];
        while($row = mysqli_fetch_array($link, $sql)){
            $id_array[] .= $row['id'];
        };
    };

    $rand_key_id_array = array_rand($id_array, 1);
    $rand_id = $id_array["$rand_key_id_array"];

    if(!empty($rand_id)){
        $request = "SELECT * FROM `recipest` WHERE `sort` = $rand_id";
        $row = mysqli_fetch_array($link, $request);
        $method = 'sendMessage';
        $chat_id = $accept_decode['callback_query']['message']['chat']['id'];
        $result = "<b>Ваш рецепт:</b>\n\n".$row['recname']."\n\n".
        "<b>Ингредиенты:</b>\n\n".$row['ingredients']."\n\n".
        "<b>Описание:</b>\n\n".$row['rec']."\n\n".
        "<b>Автор:</b> ".$row['author'];
    }else{
        $result = 'К сожалению в книге нет ни одного рецепта';
        $chat_id = $accept_decode['callback_query']['message']['chat']['id'];
        $method = 'sendMessage';
    };

    

?>
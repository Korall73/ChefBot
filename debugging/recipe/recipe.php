<?php

    $sql = 'SELECT `id` FROM `recipest`';

    $num_rows = mysqli_num_rows(mysqli_query($link, $sql));

    $rand_id = rand(1, $num_rows);
    $select = "SELECT * FROM `recipest` WHERE `id` = $rand_id";
    $request = $select;

    if($num_rows > 0){
        $row = mysqli_fetch_array(mysqli_query($link, $request));
        $result = "<b>Ваш рецепт:</b>\n\n".$row['recname']."\n\n"."<b>Ингредиенты:</b>\n\n".$row['ingredients']."\n\n"."<b>Описание:</b>\n\n".$row['rec']."\n\n\n"."<b>Автор:</b> ".$row['author'];
        $chat_id = $accept_decode['message']['chat']['id'];
        $method = 'sendMessage';
    }else{
        $result = 'К сожалению в книге нет ни одного рецепта';
        $chat_id = $accept_decode['message']['chat']['id'];
        $method = 'sendMessage';
    }

?>
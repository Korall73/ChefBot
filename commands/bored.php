<?php

    $bored = file_get_contents(API_BORED);
    $bored_decode = json_decode($bored, true);

    $result = 'Предлагаю '.$bored_decode['activity'];
    $chat_id = $accept_decode['message']['chat']['id'];
    $method = 'sendMessage';

?>
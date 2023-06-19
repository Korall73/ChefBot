<?php

    $method = 'sendMessage';
    $chat_id = $accept_decode['message']['chat']['id'];
    $result = 'Что именно вы хотите?';
    $reply_markup = array(
        'inline_keyboard' => array(
            array(
                array(
                    'text' => 'Алкоголь',
                    'callback_data' => 'Алкоголь'
                ),
                array(
                    'text' => 'Закуски',
                    'callback_data' => 'Закуски'
                )
                ),
            array(
                array(
                    'text' => 'Основное',
                    'callback_data' => 'Основное'
                ),
                array(
                    'text' => 'Десерты',
                    'callback_data' => 'Десерты'
                )
            ),
            array(
                array(
                    'text' => 'Торты',
                    'callback_data' => 'Торты'
                ),
                array(
                    'text' => 'Снеки',
                    'callback_data' => 'Снеки'
                )
            ),
            array(
                array(
                    'text' => 'Салаты',
                    'callback_data' => 'Салаты'
                ),
                array(
                    'text' => 'Супы',
                    'callback_data' => 'Супы'
                )
            )
        )
    );
    $reply_markup_json = json_encode($reply_markup);

?>
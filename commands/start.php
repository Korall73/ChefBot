<?php
    $method = 'sendMessage';
    $result = 'Привет'."!\n".
    "Я Повар Бот и подскажу, что приготовить.\n".
    "Вот что я могу:\n".
    '1. "Рецепт" - случайное блюдо.'."\n".
    'Если что-то забудешь напиши "Помощь".'."\n".
    'Жалобы и предложения можешь отправить моему создателю @Korall73';

    $chat_id = $accept_decode['message']['chat']['id'];

?>
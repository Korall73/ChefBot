<?php

    $access = "SELECT `access` FROM `admin_bot` WHERE `id_tg` = '$user_id'";
    $access_sql = mysqli_fetch_array(mysqli_query($link, $access));
    $debug_req = "UPDATE `admin_bot` SET `debug` = '$value_debug' WHERE `id_tg` = '$user_id'";
    $mes_str = strstr($text, ' ');

?>
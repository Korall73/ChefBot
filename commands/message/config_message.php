<?php

    $mes_id = strstr($text, ' ');
    $exists = "SELECT EXISTS(SELECT * FROM `admin_bot` WHERE `id_tg` = '$user_id')";
    $exists_sql = mysqli_fetch_all(mysqli_query($link, $exists));
    $access = "SELECT `access` FROM `admin_bot` WHERE `id_tg` = '$user_id'";
    $access_sql = mysqli_fetch_all(mysqli_query($link, $access));
    $mode = "SELECT `mode` FROM `admin_bot` WHERE `id_tg` = '$user_id'";
    $mode_sql = mysqli_fetch_all(mysqli_query($link, $mode));
    $admin_user_id = "SELECT `user_id` FROM `admin_bot` WHERE `id_tg` = '$user_id'";
    $admin_user_id_sql = mysqli_fetch_all(mysqli_query($link, $admin_user_id));
    $select_users_id = "SELECT `id_tg` FROM `users_private`";
    $select_users_id_sql = mysqli_fetch_all(mysqli_query($link, $select_users_id));

?>
<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '123123');
define('DATABASE', 'db');

function load_users_data($user_ids)
{
    $data = [];
    $user_ids = explode(',', $user_ids);

    /**
     * Проверка и очистка пользовательского ввода
     */
    $user_ids = array_filter($user_ids, function ($id) {
        return is_numeric($id);
    });

    if (!count($user_ids)) {
        throw new Exception('Здесь нет пользовательских ids');
    }

    /**
     * Создаем подключение к базе данных, делаем проверку подключения
     * Достаем всех пользователей с нужными нам id
     */
    if ($conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE)) {
        $sql = "SELECT * FROM `users` WHERE id IN (" . implode(',', $user_ids) . ")";
        $query = mysqli_query($conn, $sql);

        while ($obj = $query->fetch_object()) {
            $data[$obj->id] = $obj->name;
        }
        mysqli_close($conn);
    } else {
        throw new Exception('Ошибка соединения с базой данных.');
    }
    return $data;
}

/**
 * Перебираем массив из URL
 * Создаем ссылку с нужным id и именем
 */
$data = load_users_data($_GET['user_ids']);
foreach ($data as $user_id => $name) {
    echo "<a href='show_user.php?id=" . $user_id . "'>" . $name . "</a>";
}


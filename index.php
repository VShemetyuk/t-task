SELECT u.name,
COUNT(p.user_id) 'к-во номеров'
FROM users u
INNER JOIN phone_numbers p ON u.id = p.user_id
WHERE u.gender = 2 AND (YEAR(CURDATE()) - YEAR(FROM_UNIXTIME(u.birth_date))) BETWEEN 18 AND 22 GROUP BY u.id

<?php

$url_str = "https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3";
$newUrl = '/test/index.html';

function formerUrl($url_str, $newUrl)
{

    $query = parse_url($url_str, PHP_URL_QUERY);
    parse_str($query, $output);

    asort($output);

    foreach ($output as $key => $item) {
        if ($item == 3) {
            unset($output[$key]);
        }
    }

    asort($output);

    $pos = strpos($url_str, '/', 10);

    $newStr = http_build_query($output, '', '&');

    return substr($url_str, 0, $pos) . '/?' . $newStr . '&url=' . urlencode($newUrl);

}

echo formerUrl($url_str, $newUrl);
?>
<?php

class User
{

}

class Article
{
    /**
     * возможность получить автора статьи;
     *
     * @return User
     */
    public function getAuthor()
    {
    }

    /**
     * возможность сменить автора статьи.
     *
     * @param User $author
     *
     * @return void
     */
    public function setAuthor(User $author)
    {
    }
}

class ArticleManager
{
    /**
     * возможность для пользователя создать новую статью;
     *
     * @param User $author
     *
     * @return void
     */
    public function create(User $author)
    {
    }

    /**
     * возможность получить все статьи конкретного пользователя;
     *
     * @param User $author
     *
     * @return array User list
     */
    public function findAll(User $author)
    {
    }
}

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

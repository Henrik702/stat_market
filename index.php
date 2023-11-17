<?php
include 'connect.php';

echo "<h2>Выборка пользователей, у которых количество постов больше, чем у пригласившего их пользователя:</h2>";
$sql = "SELECT u1.name AS user_name, u1.posts_qty AS user_posts_qty,
           u2.name AS invited_by_name, u2.posts_qty AS invited_by_posts_qty
        FROM users u1
        JOIN users u2 ON u1.invited_by_user_id = u2.id
        WHERE u1.posts_qty > u2.posts_qty";

$result = $con->query($sql);

if ($result) {
    $params = resultToArray($result);
    foreach ($params as $row) {
        echo "Пользователь: " . $row['user_name'] . ", Постов: " . $row['user_posts_qty'] . "<br>";
        echo "Пригласил: " . $row['invited_by_name'] . ", Постов: " . $row['invited_by_posts_qty'] . "<br><br>";
    }
} else {
    echo "Ошибка при выполнении запроса: " . $con->errorInfo()[2];
}
echo '<br>';

echo "<h2>Выборка пользователей с максимальным количеством постов в своей группе:</h2>";
$sql = "SELECT u.id, u.name, u.posts_qty, u.group_id
        FROM users u
        JOIN (
            SELECT MAX(posts_qty) AS max_posts, group_id
            FROM users
            GROUP BY group_id
        ) AS max_posts_per_group ON u.group_id = max_posts_per_group.group_id AND u.posts_qty = max_posts_per_group.max_posts";

$result = $con->query($sql);

if ($result) {
    $params = resultToArray($result);

    // вывода результатов
    foreach ($params as $row) {
        echo "ID: " . $row['id'] . ", Имя: " . $row['name'] . ", Постов: " . $row['posts_qty'] . ", ID Группы: " . $row['group_id'] . "<br>";
    }
} else {
    echo "Ошибка при выполнении запроса: " . $con->errorInfo()[2];
}
echo '<br>';

echo "<h2>Выборка групп, количество пользователей в которых превышает 10000:</h2>";
$sql = "SELECT group_id, COUNT(*) AS user_count
        FROM users
        GROUP BY group_id
        HAVING COUNT(*) > 10000";

$result = $con->query($sql);

if ($result) {
    $params = resultToArray($result);

    // вывода результатов
    foreach ($params as $row) {
        echo "ID Группы: " . $row['group_id'] . ", Количество пользователей: " . $row['user_count'] . "<br>";
    }
} else {
    echo "Ошибка при выполнении запроса: " . $con->errorInfo()[2];
}
echo '<br>';

echo "<h2>Выборка пользователей, у которых пригласивший пользователь из другой группы:</h2>";
$sql = "SELECT u.id, u.name AS user_name, u.group_id AS user_group_id,
       u2.name AS invited_by_name, u2.group_id AS invited_by_group_id
FROM users u
JOIN users u2 ON u.invited_by_user_id = u2.id
WHERE u.group_id <> u2.group_id";

$result = $con->query($sql);

if ($result) {
    $params = resultToArray($result);

    // Используем foreach для вывода результатов
    foreach ($params as $row) {
        echo "ID пользователя: " . $row['id'] . ", Имя пользователя: " . $row['user_name'] . ", Группа пользователя: " . $row['user_group_id'] . "<br>";
        echo "Пригласил: " . $row['invited_by_name'] . ", Группа пригласившего: " . $row['invited_by_group_id'] . "<br><br>";
    }
} else {
    echo "Ошибка при выполнении запроса: " . $con->errorInfo()[2];
}
echo '<br>';

echo "<h2>Выборка групп с максимальным количеством постов у пользователей:</h2>";
$sql = "SELECT u.group_id, MAX(u.posts_qty) AS max_posts
        FROM users u
        GROUP BY u.group_id
        HAVING MAX(u.posts_qty) = (
            SELECT MAX(posts_qty)
            FROM users
        )";

$result = $con->query($sql);

if ($result) {
    $params = resultToArray($result);

    // вывода результатов
    foreach ($params as $row) {
        echo "ID Группы: " . $row['group_id'] . ", Максимальное количество постов: " . $row['max_posts'] . "<br>";
    }
} else {
    echo "Ошибка при выполнении запроса: " . $con->errorInfo()[2];
}
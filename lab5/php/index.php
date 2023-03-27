<?php
// Подключаемся к базе данных
$db = new PDO('mysql:host=localhost;dbname=posts;charset=utf8', 'root', '');

// Получаем id поста из параметра запроса
$id = $_GET['id'] ?? null;

if ($id !== null) {
    // Получаем данные поста из базы данных
    $statement = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $statement->execute(['id' => $id]);
    $post = $statement->fetch(PDO::FETCH_ASSOC);

    if (!empty($post)) {
        // Отображаем заголовок и содержимое поста
        echo '<h1>' . $post['title'] . '</h1>';
        echo '<p>' . $post['content'] . '</p>';
        echo '<p>Опубликовано: ' . $post['created_at'] . '</p>';
        echo '<p>Отредактировано: ' . $post['updated_at'] . '</p>';

        // Ссылки на страницу list.php
        echo "<p><a href='list.php'>Список постов</a></p>";

        // Ссылки на страницы update.php и delete.php с заданным id
        echo "<p><a href='update.php?id=$id'>Изменить пост</a></p>";
        echo "<p><a href='delete.php?id=$id'>Удалить пост</a></p>";
    } else {
        // Отображение сообщения об ошибке, если пост не найден
        echo "<p>Пост не найден!</p>";
    }
} else {
    // Отображение сообщения об ошибке, если id не задан
    echo "<p>id поста не задан!</p>";
}
?>

<?php
// Подключение к файлу XML
$posts = simplexml_load_file('posts.xml');

// Получение id поста из GET-параметра
$id = $_GET['id'] ?? null;

if ($id !== null) {
    // Поиск поста с заданным id
    $post = $posts->xpath("//post[@id='$id']")[0] ?? null;

    if ($post !== null) {
        // Отображение информации о посте
        echo "<h2>{$post->title}</h2>";
        echo "<p>{$post->content}</p>";
        echo "<p>Опубликовано: {$post->published}</p>";
        echo "<p>Отредактировано: {$post->last_edited}</p>";

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

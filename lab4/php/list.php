<?php
// Подключение к файлу XML
$posts = simplexml_load_file('posts.xml');

// Отображение списка постов
echo "<h2>Посты</h2>";
echo "<ul>";
foreach ($posts->post as $post) {
    $id = $post['id'];
    echo "<li><a href='index.php?id=$id'>{$post->title}</a></li>";
}
echo "</ul>";

// Ссылка на страницу create.php
echo "<p><a href='create.php'>Добавить новый пост</a></p>";
?>

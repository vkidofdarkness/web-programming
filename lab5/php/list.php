<?php
// Подключаемся к базе данных
$db = new PDO('mysql:host=localhost;dbname=posts;charset=utf8', 'root', '');

// Получаем список всех постов из базы данных
$statement = $db->prepare('SELECT * FROM posts');
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

// Отображаем список всех постов в виде гиперссылок
echo "<h2>Посты</h2>";
echo '<ul>';
foreach ($posts as $post) {
    echo '<li><a href="index.php?id=' . $post['id'] . '">' . $post['title'] . '</a></li>';
}
echo '</ul>';

// Добавляем ссылку на страницу create.php
echo "<p><a href='create.php'>Добавить новый пост</a></p>";
?>

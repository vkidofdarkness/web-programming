<?php
// Подключаемся к базе данных
$db = new PDO('mysql:host=localhost;dbname=posts;charset=utf8', 'root', '');

// Получаем id поста из параметра запроса
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Если id не задан, перенаправляем на список постов
if (!$id) {
    header('Location: list.php');
    exit;
}

// Получаем данные поста из базы данных
$statement = $db->prepare('SELECT * FROM posts WHERE id = :id');
$statement->execute(['id' => $id]);
$post = $statement->fetch(PDO::FETCH_ASSOC);

// Если пост не найден, перенаправляем на список постов
if (!$post) {
    header('Location: list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Удаляем данные поста из базы данных
    $statement = $db->prepare('DELETE FROM posts WHERE id = :id');
    $statement->execute(['id' => $id]);

    // Перенаправляем пользователя на страницу list.php
    header('Location: list.php');
    exit;
}

// HTML-код страницы удаления поста
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Удаление поста</title>
</head>
<body>
    <h1>Удалить пост</h1>
    <p>Вы уверены, что хотите удалить данный пост?</p>
    <p><strong>Заголовок:</strong> <?php echo $post['title']; ?></p>
    <p><strong>Содержание:</strong> <?php echo $post['content']; ?></p>
    <p><strong>Опубликовано:</strong> <?php echo $post['created_at']; ?></p>
    <p><strong>Отредактировано:</strong> <?php echo $post['updated_at']; ?></p>
    <form method="post">
        <!-- Подтверждение удаления поста -->
        <p><input type="submit" value="Удалить"></p>
    </form>
</body>
</html>
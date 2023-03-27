<?php
// Получаем id поста из параметра запроса
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Если id не задан, перенаправляем на список постов
if (!$id) {
    header('Location: list.php');
    exit;
}

// Загружаем данные из XML-файла
$xml = simplexml_load_file('posts.xml');

// Ищем пост с заданным id
$post = $xml->xpath("//post[@id='$id']");

// Если пост не найден, перенаправляем на список постов
if (!$post) {
    header('Location: list.php');
    exit;
}

// Если форма была отправлена, удаляем пост
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Удаляем пост из XML-файла
    unset($post[0][0]);
    $xml->asXML('posts.xml');
    // Перенаправляем на список постов
    header('Location: list.php');
    exit;
}

// HTML-код страницы удаления поста
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Delete Post</title>
</head>
<body>
    <h1>Удалить пост</h1>
    <p>Вы уверены, что хотите удалить данный пост?</p>
    <p><strong>Заголовок:</strong> <?php echo $post[0]->title; ?></p>
    <p><strong>Содержание:</strong> <?php echo $post[0]->content; ?></p>
    <p><strong>Опубликовано:</strong> <?php echo $post[0]->published; ?></p>
    <p><strong>Отредактировано:</strong> <?php echo $post[0]->last_edited; ?></p>
    <form method="post">
        <!-- Подтверждение удаления поста -->
        <p><input type="submit" value="Удалить"></p>
    </form>
</body>
</html>
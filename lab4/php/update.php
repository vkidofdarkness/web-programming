<?php
// Подключение к файлу XML
$posts = simplexml_load_file('posts.xml');

// Получение идентификатора поста из параметра id
$id = $_GET['id'] ?? '';
$post = $posts->xpath("/posts/post[@id='$id']")[0];

// Если форма отправлена, то обновляем пост
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    // Валидация данных
    $errors = [];
    if (empty($title)) {
        $errors[] = 'Title is required';
    }
    if (empty($content)) {
        $errors[] = 'Content is required';
    }

    // Если ошибок нет, то обновляем пост
    if (empty($errors)) {
        $post->title = $title;
        $post->content = $content;
        $post->last_edited = date('Y-m-d H:i:s');

        // Сохранение изменений в файл XML
        $posts->asXML('posts.xml');

        // Перенаправление на страницу обновленного поста
        header("Location: index.php?id=$id");
        exit;
    }
} else {
    // Извлечение данных поста для заполнения формы
    $title = (string) $post->title;
    $content = (string) $post->content;
}
?>
<!-- Форма для обновления поста -->
<h2>Обновить пост</h2>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form method="POST">
    <div class="form-group">
        <label for="title">Заголовок</label>
        <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>">
    </div><br>
    <div class="form-group">
        <label for="content">Содержание</label>
        <textarea name="content" id="content" class="form-control"><?php echo htmlspecialchars($content); ?></textarea>
    </div><br>
    <button type="submit" class="btn btn-primary">Изменить пост</button>
</form>
<!-- Ссылка на страницу удаления поста -->
<a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger">Удалить пост</a>

<?php
// Подключаемся к базе данных
$db = new PDO('mysql:host=localhost;dbname=posts;charset=utf8', 'root', '');

// Получаем id поста из параметра запроса
$id = $_GET['id'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
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
        $statement = $db->prepare('UPDATE posts SET title = :title, content = :content, updated_at = CURRENT_TIMESTAMP WHERE id = :id');
        $statement->execute([
            'title' => $title,
            'content' => $content,
            'id' => $id
        ]);

        // Перенаправляем пользователя на страницу index.php с заданным id
        header('Location: index.php?id=' . $id);
        exit();
    }    
}

// Получаем данные поста из базы данных
$statement = $db->prepare('SELECT * FROM posts WHERE id = :id');
$statement->execute(['id' => $id]);
$post = $statement->fetch(PDO::FETCH_ASSOC);
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
        <input type="text" name="title" id="title" class="form-control" value="<?php echo $post['title']; ?>">
    </div><br>
    <div class="form-group">
        <label for="content">Содержание</label>
        <textarea name="content" id="content" class="form-control"><?php echo $post['content']; ?></textarea>
    </div><br>
    <button type="submit" class="btn btn-primary">Изменить пост</button>
</form>
<!-- Ссылка на страницу удаления поста -->
<a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger">Удалить пост</a>

<?php
// Подключаемся к базе данных
$db = new PDO('mysql:host=localhost;dbname=posts;charset=utf8', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $title = $_POST['title'];
    $content = $_POST['content'];

      // Валидация данных
    $errors = [];
    if (empty($title)) {
        $errors[] = 'Заголовок поста пустой!';
    }
    if (empty($content)) {
        $errors[] = 'Содержание поста пустое!';
    }

    // Если ошибок нет, то добавляем новый пост
    if (empty($errors)) {
        // Добавляем новый пост в базу данных
        $statement = $db->prepare('INSERT INTO posts (title, content) VALUES (:title, :content)');
        $statement->execute([
            'title' => $title,
            'content' => $content
        ]);

        // Получаем id нового поста
        $id = $db->lastInsertId();

        // Перенаправляем пользователя на страницу index.php с новым id
        header("Location: index.php?id=$id");
        exit;
    }    
}
?>

<h2>Добавление поста</h2>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form method="post">
    <div class="form-group">
        <label for="title">Заголовок</label>
        <input type="text" name="title" id="title" class="form-control" value="<?php $title = null; echo htmlspecialchars($title); ?>">
    </div><br>
    <div class="form-group">
        <label for="content">Содержание</label>
        <textarea name="content" id="content" class="form-control"><?php $content = null; echo htmlspecialchars($content); ?></textarea>
    </div><br>
    <button type="submit" class="btn btn-primary">Создать пост</button>
</form>
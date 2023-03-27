<?php
// Обработчик POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
  $title = $_POST['title'];
  $content = $_POST['content'];
  $published = date('Y-m-d H:i:s');
  $last_edited = $published;
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
      // Подключение к файлу XML
      $posts = simplexml_load_file('posts.xml');

      // Ищем максимальный id
      $max_id = 0;
      foreach ($posts->post as $post) {
          $id = (int) $post['id'];
          if ($id > $max_id) {
              $max_id = $id;
          }
      }

      // Создание нового поста
      $id = $max_id + 1;
      $post = $posts->addChild('post');
      $post->addAttribute('id', $id);
      $post->addChild('title', $title);
      $post->addChild('content', $content);
      $post->addChild('published', date('Y-m-d H:i:s'));
      $post->addChild('last_edited', date('Y-m-d H:i:s'));

      // Сохранение изменений в файл XML
      $posts->asXML('posts.xml');

      // Перенаправление на страницу созданного поста
      header("Location: index.php?id=$id");
      exit;
  }
}  
?>
<!-- Форма для добавления нового поста -->
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
<form method="POST">
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

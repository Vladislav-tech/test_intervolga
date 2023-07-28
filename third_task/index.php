<?php

declare(strict_types=1);

require_once 'includes/db.php';

// Получение списка комментариев
$comments = [];
try {
  $stmt = $pdo->query("SELECT * FROM comments ORDER BY created_at DESC");
  $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die('Ошибка при получении комментариев: ' . $e->getMessage());
}

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $comment = $_POST['comment'];

  // Валидация данных
  if (empty($name) || empty($comment)) {
    die('Пожалуйста, заполните все поля');
  }

  // Добавление нового комментария в базу данных
  try {
    $stmt = $pdo->prepare("INSERT INTO comments (name, comment) VALUES (?, ?)");
    $stmt->execute([$name, $comment]);
    header("Location: index.php");
    exit();
  } catch (PDOException $e) {
    die('Ошибка при добавлении комментария: ' . $e->getMessage());
  }
}

// Обработка удаления комментария
if (isset($_GET['delete_id'])) {
  $deleteId = $_GET['delete_id'];

  try {
    $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->execute([$deleteId]);
    header("Location: index.php");
    exit();
  } catch (PDOException $e) {
    die('Ошибка при удалении комментария: ' . $e->getMessage());
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Список комментариев</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
  <div class="container">
    <h1>Список комментариев</h1>

    <form method="POST">
      <div class="input-field">
        <input type="text" id="name" name="name" required>
        <label for="name">Имя</label>
      </div>
      <div class="input-field">
        <textarea id="comment" name="comment" class="materialize-textarea" required></textarea>
        <label for="comment">Комментарий</label>
      </div>
      <button class="btn waves-effect waves-light" type="submit" name="action">Добавить комментарий
        <i class="material-icons right">send</i>
      </button>
    </form>

    <h2>Комментарии:</h2>

    <?php foreach ($comments as $comment) : ?>
      <div class="card">
        <p class="comment-text">
          <?= $comment['comment'] ?>
        </p>
        <p class="comment-meta">
          <?= $comment['name'] ?>, 
          <?= $comment['created_at'] ?>
        </p>
        <div class="comment-actions">
          <i class="material-icons comment-delete-btn" onclick="deleteComment(<?= $comment['id'] ?>)">delete</i>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <script>
    // Подтвердить удаление
    function deleteComment(id) {
      if (confirm("Вы уверены, что хотите удалить комментарий?")) {
        window.location.href = "index.php?delete_id=" + id;
      }
    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
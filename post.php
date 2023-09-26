<!DOCTYPE html>
<html lang="ru">
<?php 
$user = 'root';
$password = 'root';
$db = 'web-block';
$host = 'localhost';
$port = 3306;

$dsn = 'mysql:host='.$host.';dbname='.$db.';port='.$port;
$pdo = new PDO($dsn, $user, $password);

$sql = 'SELECT * FROM article WHERE `id` = ?';
$query = $pdo->prepare($sql);
$query->execute([$_GET['id']]);


$article = $query->fetch(PDO::FETCH_OBJ);

$website_title = $article->title;
include 'blocks/head.php'; 
?>
<body>
  <?php include 'blocks/headers.php'; ?>
  <main>
    <?php
    echo "<div class='post'>
            <h1>" . $article->title . "</h1>
            <p>". $article->anons ."</p></br>
            <p>". $article->full_text ."</p>
            <p class='avtor'>Автор: <span>". $article->avtor ."</span></p>
          </div>";
    ?>
    <h3>Комментарии</h3>
    <form id="commentForm">
      <?php if(isset($_COOKIE['login'])): ?>
        <label for="username">Ваше имя</label></br>
        <input type="text" name="username" id="username" value="<?= $_COOKIE['login'] ?>"></br>
      <?php else:?>
        <label for="username">Ваше имя</label></br>
        <input type="text" name="username" id="username"></br>
      <?php endif; ?>
      <label for="mess">Сообщение</label></br>
      <textarea name="mess" id="mess"></textarea></br>

      <div class="error-mess" id="error-block"></div>
      <button type="button" id="mess_send">Добавить комментарий</button>
    </form>
        <div class="comments">
        <?php
            $sql = 'SELECT * FROM comments WHERE `article_id` = ? ORDER BY id DESC';
            $query = $pdo->prepare($sql);
            $query->execute([$_GET['id']]);

            $somments = $query->fetchAll(PDO::FETCH_OBJ);
            foreach($somments as $el) {
                echo "<div class='comment'><h2>".$el->name."</h2><div>".$el->massage."</div></div>";
            }
        ?>
        </div>


  </main>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $('#mess_send').click(function() {
    let name = $('#username').val();
    let mess = $('#mess').val();
    $.ajax({
      url: 'ajax/comment_add.php',
      type: 'POST',
      cache: false,
      data: {'username': name, 'mess': mess, 'id': '<?=$_GET['id']?>'},
      dataType: 'html', 
      success: function(data) {
        if(data === "Done") { 
          $('.comments').prepend(
            "<div class='comment'><h1>" + name + "</h1><p>" + mess + "</p></div>"
          );
          $('#mess_send').text("Всё готово");
          $("#error-block").hide();
          $('#mess').val("");
        } else {
          $("#error-block").show();
          $("#error-block").text(data);
        }
      }
    });
  });
</script>

  <?php include 'blocks/aside.php'; ?>
  <?php include 'blocks/footer.php'; ?>
</body>
</html>

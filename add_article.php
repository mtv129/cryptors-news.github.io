<?php 
if (!isset($_COOKIE['login'])) {
    header('Location: /register.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<?php 
$website_title = 'Добавить статью';
include 'blocks/head.php'; 
?>
<body>
<?php include 'blocks/headers.php'; ?>
  <main>
    <h1>Добавить статью</h1>
    <form>
      <label for="title">название статьи</label><br>
      <input type="text" name="title" id="title"><br>

      <label for="anons">анонс статьи</label><br>
      <textarea name="anons" id="anons"></textarea><br>

      <label for="full_text">основной текст</label><br>
      <textarea name="full_text" id="full_text"></textarea><br>

      <div class="error-mess" id="error-block"></div>

      <button type="button" id="add_article">добавить</button>
    </form>
  </main>

  <?php include 'blocks/aside.php'; ?>
  <?php include 'blocks/footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#add_article').click(function(){
      let title = $('#title').val();
      let anons = $('#anons').val();
      let full_text = $('#full_text').val();

      $.ajax({
          url: 'ajax/add_article.php',
          type: 'POST',
          cache: false,
          data: {
              'title': title,
              'anons': anons,
              'full_text': full_text,
          },
          dataType: 'html', 
          success: function(data){
            if(data === "Done"){ 
                $('#add_article').text("Всё готово");
                $("#error-block").hide();
            }else{
                $("#error-block").show();
                $("#error-block").text(data);
            }
          }
      });
    });
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="ru">
<?php 
$website_title = 'Конаткы';
include 'blocks/head.php'; 
?>
<body>
<?php include 'blocks/headers.php'; ?>
  <main>
    <h1>Контакты</h1>
    <form>
      <label for="username">ваше им</label><br>
      <input type="text" name="username" id="username"><br>

      <label for="email">email</label><br>
      <textarea name="email" id="email"></textarea><br>

      <label for="mess">ваше сообщение</label><br>
      <textarea name="mess" id="mess"></textarea><br>

      <div class="error-mess" id="error-block"></div>

      <button type="button" id="mess_send">отправить</button>
    </form>
  </main>

  <?php include 'blocks/aside.php'; ?>
  <?php include 'blocks/footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#mess_send').click(function(){
      let name = $('#username').val();
      let email = $('#email').val();
      let mess = $('#mess').val();

      $.ajax({
          url: 'ajax/mail.php',
          type: 'POST',
          cache: false,
          data: {
              'name': name,
              'email': email,
              'mess': mess,
          },
          dataType: 'html', 
          success: function(data){
            if(data === "Done"){ 
                $('#mess_send').text("Всё готово");
                $("#error-block").hide();
                $("#username").val("");
                $("#email").val("");
                $("#mess").val("");
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

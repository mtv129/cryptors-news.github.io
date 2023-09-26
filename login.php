<!DOCTYPE html>
<html lang="ru">
<?php 
$website_title = 'Registr';
include 'blocks/head.php'; 
?>
<body>
<?php include 'blocks/headers.php'; ?>
  <main>
    <?php if(!isset($_COOKIE['login'])) : ?>
    <h1>Авторизация</h1>
    <form>
      <label for="login">Логин</label></br>
      <input type="text" name="login" id="login"></br>

      <label for="password">Пароль</label></br>
      <input type="password" name="password" id="password"></br>

      <div class="error-mess" id="error-block"></div>
      <button type="button" id="login_user">Войти</button>
    </form>
    <?php else: ?>
        <h2><?= $_COOKIE['login'] ?></h2>
        <form>
            <button type="button" id="exit_user">Выйти</button>
        </form>
    <?php endif; ?>
  </main>

  <?php include 'blocks/aside.php'; ?>
  <?php include 'blocks/footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#login_user').click(function(){
      let login = $('#login').val();
      let pass = $('#password').val();

      $.ajax({
        url: 'ajax/login.php',
        type: 'POST',
        cache: false,
        data: {'login': login, 'password': pass},
        dataType: 'html', 
        success: function(data){
          if(data === "Done"){
            $('#login_user').text("Всё готово");
            $("#error-block").hide();
            document.location.reload(true);
          }else{
            $("#error-block").show();
            $("#error-block").text(data);
          }
        }
      });
    });
    
    $('#exit_user').click(function(){
      $.ajax({
        url: 'ajax/exit.php',
        type: 'POST',
        cache: false,
        data: {},
        dataType: 'html', 
        success: function(data){
            document.location.reload(true);
        }
      });
    });
  </script>
</body>
</html>

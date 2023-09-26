<!DOCTYPE html>
<html lang="ru">
<?php 
$website_title = 'Registr';
include 'blocks/head.php'; 
?>
<body>
<?php include 'blocks/headers.php'; ?>
  <main>
    <h1>Регистрация</h1>
    <form>
      <label for="username">Ваше имя</label></br>
      <input type="text" name="username" id="username"></br>

      <label for="email">Email</label></br>
      <input type="email" name="email" id="email"></br>
      
      <label for="login">Логин</label></br>
      <input type="text" name="login" id="login"></br>

      <label for="password">Пароль</label></br>
      <input type="password" name="password" id="password"></br>

      <div class="error-mess" id="error-block"></div>
      <button type="button" id="reg_user" href="/login.php">Зарегистрирыватсья</button>
    </form>
  </main>

  <?php include 'blocks/aside.php'; ?>
  <?php include 'blocks/footer.php'; ?>
  <script>
    $('#reg_user').click(function(){
  let name = $('#username').val();
  let email = $('#email').val();
  let login = $('#login').val();
  let pass = $('#password').val();

  $.ajax({
    url: 'ajax/reg.php',
    type: 'POST',
    cache: false,
    data: {'username': name, 'email': email, 'login': login, 'password': pass},
    dataType: 'html', 
    success: function(data){
      if(data === "Done"){ 
        $('#reg_user').text("Всё готово");
        $("#error-block").hide();
        location.href = "/login.php";
      }else{
        $("#error-block").show();
        $("#error-block").text(data);
      }
    }
  });
})

  </script>
</body>
</html>
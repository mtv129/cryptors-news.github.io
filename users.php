<!DOCTYPE html>
<html lang="ru">
<?php 
$website_title = 'Blog Master';
include 'blocks/head.php'; 
?>
<body>
  <?php include 'blocks/headers.php'; ?>
  <main>
    <h1>Список пользователей</h1></br>
    <ul>
        <?php
        $user = 'root';
        $password = 'root';
        $db = 'web-block';
        $host = 'localhost';
        $port = 3306;
        
        $dsn = 'mysql:host='.$host.';dbname='.$db.';port='.$port;
        $pdo = new PDO($dsn, $user, $password);

        $sql = "SELECT id, login, name FROM users";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<li>Login: ' . $row['login'] . ', Name: ' . $row['name'] . ' <button class="delete-button" data-id="' . $row['id'] . '" onclick="deleteUser(' . $row['id'] . ')"><svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg></button></li>';
        } 
        ?>
    </ul>
  </main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function deleteUser(userId) {
    $.ajax({
        url: "ajax/delet.php",
        method: "POST",
        data: { id: userId },
        success: function(response) {
                $("button[data-id='" + userId + "']").closest("li").remove();
        }
    });
}
</script>
  <?php include 'blocks/aside.php'; ?>
  <?php include 'blocks/footer.php'; ?>
</body>
</html>



<main>
    <?php
    $user = 'root';
    $password = 'root';
    $db = 'web-block';
    $host = 'localhost';
    $port = 3306;
    
    $dsn = 'mysql:host='.$host.';dbname='.$db.';port='.$port;
    $pdo = new PDO($dsn, $user, $password);

    $sql = 'SELECT * FROM article ORDER BY `date` DESC';
    $query = $pdo->query($sql);
    while($row = $query->fetch(PDO::FETCH_OBJ)){
        echo "<div class='post'>
            <h1>" . $row->title . "</h1>
            <p>". $row->anons ."</p>
            <p class='avtor'>Автор: <span>". $row->avtor ."</span></p>
            <a href='/post.php?id=" . $row->id ."' title='".$row->title."'>Прочитать</a>
        </div>";
    }
    ?>
</main>
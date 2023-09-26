<header>
<span class="logo">BLog Master</span>
<nav>
    <a href="/">гланая</a>
    <a href="/contacts.php">контакты</a>
    <?php if(isset($_COOKIE['login'])) : ?>
        <a href="/add_article.php" class="">добавить статсью</a>
        <a href="/login.php" class="">кабинет пользывателя</a>
    <?php else : ?>
        <a href="/login.php" class="btn">войти</a>
        <a href="/register.php" class="btn">регистариция</a>
    <?php endif; ?>
</nav>
</header>
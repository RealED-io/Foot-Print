<?php
require __DIR__ . '/../layouts/header.php';
?>

    <form method="POST" action="<?= BASE_URL ?>/login">
        <label for="email">
            Email
            <input id="email" name="email" placeholder="Email">
        </label>
        <label for="password">
            Password
            <input id="password" name="password" type="password" placeholder="Password">
        </label>
        <button>Login</button>
    </form>

    <a href="<?= BASE_URL ?>/register">
        Create an account
    </a>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
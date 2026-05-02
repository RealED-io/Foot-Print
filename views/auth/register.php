<?php
require __DIR__ . '/../layouts/header.php';
?>

    <section>
        <form method="POST" action="<?= BASE_URL ?>/register">
            <label for="name">
                Name
                <input id="name" name="name" placeholder="Name">
            </label>
            <label for="email">
                Email
                <input id="email" name="email" placeholder="Email">
            </label>
            <label for="password">
                Password
                <input id="password" name="password" type="password" placeholder="Password">
            </label>
            <button>Register</button>
        </form>
    </section>

    <section>
        <a href="<?= BASE_URL ?>/login">
            Login
        </a>
    </section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
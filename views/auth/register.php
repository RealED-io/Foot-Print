<form method="POST" action="<?= BASE_URL ?>/register">
    <label for="name">
        <input id="name" name="name" placeholder="Name">
    </label>
    <label for="email">
        <input id="email" name="email" placeholder="Email">
    </label>
    <label for="password">
        <input id="password" name="password" type="password" placeholder="Password">
    </label>
    <button>Register</button>
</form>

<a href="<?= BASE_URL ?>/login">
    Login
</a>
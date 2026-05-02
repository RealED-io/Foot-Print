<!DOCTYPE html>
<html lang="en">
<head>
    <title>Foot-Print</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="<?= BASE_URL ?> ./styles.css">
</head>

<body>

<header class="header">

    <div class="logo">
        <a href="<?= HOME_URL ?>">Foot-Print</a>
    </div>

    <nav class="nav">

        <a href="<?= BASE_URL ?>/dashboard">Dashboard</a>
        <a href="<?= BASE_URL ?>/activities">Activities</a>

        <?php if (IS_LOGGED_IN): ?>
            <a href="<?= BASE_URL ?>/logout">Logout</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/login">Login</a>
        <?php endif; ?>
    </nav>
</header>

<main class="container">
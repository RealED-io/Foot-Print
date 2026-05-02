<?php require __DIR__ . '/../layouts/header.php'; ?>

    <h2>Admin Access</h2>

    <form method="POST" action="<?= BASE_URL ?>/admin/reference-activities">
        <input type="password" name="admin_password" placeholder="Admin Password" required>
        <button type="submit">Enter</button>
    </form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
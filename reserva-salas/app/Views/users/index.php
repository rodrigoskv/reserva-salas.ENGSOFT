<?= $this->include('templates/header') ?>

<h2>Users</h2>
<ul>
    <?php foreach($users as $user): ?>
        <li><?= esc($user['name']) ?> (<?= esc($user['email']) ?>)</li>
    <?php endforeach; ?>
</ul>

<?= $this->include('templates/footer') ?>

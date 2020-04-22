<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {

    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $company = isset($_POST['company']) ? $_POST['company'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');

    $stmt = $pdo->prepare('INSERT INTO cards VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $email, $phone, $company, $created]);

    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
    <h2>Create Card</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id" required>
        <input type="text" name="name" placeholder="John Doe" id="name" required>
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" id="email" required>
        <input type="text" name="phone" placeholder="2025550143" id="phone" required>
        <label for="company">Company</label>
        <label for="created">Date de création</label>
        <input type="text" name="company" placeholder="Your company" id="company" required>
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created" required>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>

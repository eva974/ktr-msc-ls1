<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $company = isset($_POST['company']) ? $_POST['company'] : '';
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
        $stmt = $pdo->prepare('UPDATE cards SET id = ?, name = ?, email = ?, phone = ?, company = ?, created = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email, $phone, $company, $created, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM cards WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $card = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$card) {
        exit('Card doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
    <h2>Update Card #<?=$card['id']?></h2>
    <form action="update.php?id=<?=$card['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="1" value="<?=$card['id']?>" id="id" required>
        <input type="text" name="name" placeholder="John Doe" value="<?=$card['name']?>" id="name" required>
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" value="<?=$card['email']?>" id="email" required>
        <input type="text" name="phone" placeholder="2025550143" value="<?=$card['phone']?>" id="phone" required>
        <label for="company">Company</label>
        <label for="created">Created</label>
        <input type="text" name="company" placeholder="Employee" value="<?=$card['company']?>" id="company" required>
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($card['created']))?>" id="created" required>
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>

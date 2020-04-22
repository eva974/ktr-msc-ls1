<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM cards WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $card = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$card) {
        exit('Card doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM cards WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the card!';
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
    <h2>Delete Card #<?=$card['id']?></h2>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php else: ?>
        <p>Are you sure you want to delete card #<?=$card['id']?>?</p>
        <div class="yesno">
            <a href="delete.php?id=<?=$card['id']?>&confirm=yes">Yes</a>
            <a href="delete.php?id=<?=$card['id']?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>

<?=template_footer()?>

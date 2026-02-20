<?php
// admin/messages.php
include 'header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$id]);
    redirect('messages.php', 'Message deleted successfully!');
}

$messages = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll();
?>

<div class="animate">
    <h1 style="margin-bottom: 30px;">Inbound Messages</h1>
    
    <?php if ($messages): ?>
        <div style="display: grid; gap: 20px;">
            <?php foreach ($messages as $msg): ?>
                <div style="background: var(--card-bg); padding: 25px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05); position: relative;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <h3 style="color: var(--primary-color);"><?php echo $msg['name']; ?></h3>
                            <p style="font-size: 0.9rem; color: var(--text-muted);"><?php echo $msg['email']; ?></p>
                        </div>
                        <span style="font-size: 0.8rem; color: var(--text-muted);"><?php echo formatDate($msg['created_at']); ?></span>
                    </div>
                    <p style="white-space: pre-wrap; margin-bottom: 20px;"><?php echo $msg['message']; ?></p>
                    <a href="?delete=<?php echo $msg['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this message?')"><i class="fas fa-trash"></i> Delete</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p style="text-align: center; color: var(--text-muted); padding: 50px;">No messages received yet.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

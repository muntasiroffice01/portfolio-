<?php
// admin/dashboard.php
include 'header.php';

// Fetch stats
$projects_count = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
$blogs_count = $pdo->query("SELECT COUNT(*) FROM blogs")->fetchColumn();
$messages_count = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
$exp_count = $pdo->query("SELECT COUNT(*) FROM experiences")->fetchColumn();
?>

<div class="animate">
    <h1 style="margin-bottom: 30px;">Overview</h1>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Projects</h3>
            <p><?php echo $projects_count; ?></p>
        </div>
        <div class="stat-card">
            <h3>Blog Posts</h3>
            <p><?php echo $blogs_count; ?></p>
        </div>
        <div class="stat-card">
            <h3>New Messages</h3>
            <p><?php echo $messages_count; ?></p>
        </div>
        <div class="stat-card">
            <h3>Experiences</h3>
            <p><?php echo $exp_count; ?></p>
        </div>
    </div>

    <div style="background: var(--card-bg); padding: 30px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05);">
        <h2 style="margin-bottom: 20px;">Welcome back, <?php echo $_SESSION['admin_username']; ?>!</h2>
        <p style="color: var(--text-muted);">Use the sidebar to manage your portfolio content, blog posts, and view incoming messages.</p>
    </div>
</div>

<?php include 'footer.php'; ?>

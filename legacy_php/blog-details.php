<?php
// blog-details.php
include 'includes/header.php';

if (!isset($_GET['slug'])) {
    header("Location: blog.php");
    exit();
}

$slug = $_GET['slug'];
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE slug = ?");
$stmt->execute([$slug]);
$blog = $stmt->fetch();

if (!$blog) {
    header("Location: blog.php");
    exit();
}
?>

<main class="container" style="padding-top: 120px;">
    <article class="blog-content animate" style="max-width: 800px; margin: 0 auto;">
        <span style="color: var(--primary-color); text-transform: uppercase; font-weight: 700;"><?php echo $blog['category']; ?></span>
        <h1 style="font-size: 3rem; margin: 20px 0;"><?php echo $blog['title']; ?></h1>
        <div style="color: var(--text-muted); margin-bottom: 40px;">
            <span><i class="far fa-calendar-alt"></i> <?php echo formatDate($blog['created_at']); ?></span>
        </div>
        
        <?php if ($blog['image']): ?>
            <img src="assets/images/blog/<?php echo $blog['image']; ?>" alt="<?php echo $blog['title']; ?>" style="width: 100%; border-radius: 20px; margin-bottom: 40px;">
        <?php endif; ?>
        
        <div class="content" style="font-size: 1.15rem; line-height: 1.8;">
            <?php echo nl2br($blog['content']); ?>
        </div>
        
        <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.1);">
            <a href="blog.php" style="color: var(--primary-color); font-weight: 600;">← Back to Blogs</a>
        </div>
    </article>
</main>

<?php include 'includes/footer.php'; ?>

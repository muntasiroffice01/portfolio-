<?php
// blog.php
include 'includes/header.php';

// Fetch blogs from DB
$stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll();
?>

<main class="container" style="padding-top: 100px;">
    <section class="blog-section animate">
        <h2 style="font-size: 2.5rem; margin-bottom: 30px;">Blog</h2>
        <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px;">
            <?php if ($blogs): ?>
                <?php foreach ($blogs as $blog): ?>
                    <article class="blog-card" style="background: var(--card-bg); border-radius: 20px; overflow: hidden; transition: 0.3s; border: 1px solid rgba(255,255,255,0.05);">
                        <img src="assets/images/blog/<?php echo $blog['image'] ?: 'default-blog.jpg'; ?>" alt="<?php echo $blog['title']; ?>" style="width: 100%; height: 200px; object-fit: cover;">
                        <div style="padding: 25px;">
                            <span style="font-size: 0.8rem; color: var(--primary-color); text-transform: uppercase; font-weight: 700;"><?php echo $blog['category']; ?></span>
                            <h3 style="margin: 10px 0; font-size: 1.5rem;"><?php echo $blog['title']; ?></h3>
                            <p style="color: var(--text-muted); margin-bottom: 20px;"><?php echo $blog['short_description']; ?></p>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.85rem; color: var(--text-muted);"><i class="far fa-calendar-alt"></i> <?php echo formatDate($blog['created_at']); ?></span>
                                <a href="blog-details.php?slug=<?php echo $blog['slug']; ?>" style="color: var(--primary-color); font-weight: 600;">Read More →</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No blog posts published yet.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

<?php
// projects.php
include 'includes/header.php';

// Fetch projects from DB
$stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
$projects = $stmt->fetchAll();
?>

<main class="container" style="padding-top: 100px;">
    <section class="projects-section animate">
        <h2 style="font-size: 2.5rem; margin-bottom: 30px;">My Projects</h2>
        <div class="projects-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
            <?php if ($projects): ?>
                <?php foreach ($projects as $project): ?>
                    <div class="project-card" style="background: var(--card-bg); border-radius: 20px; overflow: hidden; transition: 0.3s; border: 1px solid rgba(255,255,255,0.05);">
                        <img src="assets/images/projects/<?php echo $project['image']; ?>" alt="<?php echo $project['title']; ?>" style="width: 100%; height: 200px; object-fit: cover;">
                        <div style="padding: 20px;">
                            <h3 style="margin-bottom: 10px;"><?php echo $project['title']; ?></h3>
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 15px;"><?php echo $project['description']; ?></p>
                            <p style="font-size: 0.8rem; margin-bottom: 20px;"><strong style="color: var(--primary-color);">Stack:</strong> <?php echo $project['tech_stack']; ?></p>
                            <div style="display: flex; gap: 15px;">
                                <a href="<?php echo $project['github_link']; ?>" target="_blank" style="color: var(--primary-color);"><i class="fab fa-github"></i> Source</a>
                                <a href="<?php echo $project['live_demo']; ?>" target="_blank" style="color: var(--primary-color);"><i class="fas fa-external-link-alt"></i> Demo</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No projects showcased yet.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

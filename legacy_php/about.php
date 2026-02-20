<?php
// about.php
include 'includes/header.php';

// Fetch experiences from DB
$stmt = $pdo->query("SELECT * FROM experiences ORDER BY id DESC");
$experiences = $stmt->fetchAll();
?>

<main class="container" style="padding-top: 100px;">
    <section class="about-section animate">
        <h2 style="font-size: 2.5rem; margin-bottom: 30px;">About Me</h2>
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 50px;">
            <div>
                <img src="assets/images/profile.jpg" alt="Profile" style="border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            </div>
            <div>
                <p style="font-size: 1.1rem; color: var(--text-muted); margin-bottom: 20px;">
                    I am a passionate Full-Stack Developer with over 5 years of experience in building modern web applications. 
                    I love solving complex problems and creating intuitive user experiences.
                </p>
                <h3 style="margin: 30px 0 15px;">My Skills</h3>
                <div class="skills-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="skill-card" style="background: var(--card-bg); padding: 15px; border-radius: 10px;">
                        <span>PHP / MySQL</span>
                        <div style="height: 8px; background: #333; border-radius: 4px; margin-top: 10px;">
                            <div style="width: 90%; height: 100%; background: var(--accent-gradient); border-radius: 4px;"></div>
                        </div>
                    </div>
                    <div class="skill-card" style="background: var(--card-bg); padding: 15px; border-radius: 10px;">
                        <span>JavaScript (ES6+)</span>
                        <div style="height: 8px; background: #333; border-radius: 4px; margin-top: 10px;">
                            <div style="width: 85%; height: 100%; background: var(--accent-gradient); border-radius: 4px;"></div>
                        </div>
                    </div>
                    <div class="skill-card" style="background: var(--card-bg); padding: 15px; border-radius: 10px;">
                        <span>HTML5 / CSS3</span>
                        <div style="height: 8px; background: #333; border-radius: 4px; margin-top: 10px;">
                            <div style="width: 95%; height: 100%; background: var(--accent-gradient); border-radius: 4px;"></div>
                        </div>
                    </div>
                    <div class="skill-card" style="background: var(--card-bg); padding: 15px; border-radius: 10px;">
                        <span>React / Vue</span>
                        <div style="height: 8px; background: #333; border-radius: 4px; margin-top: 10px;">
                            <div style="width: 80%; height: 100%; background: var(--accent-gradient); border-radius: 4px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="experience-section animate" style="margin-top: 80px;">
        <h2 style="font-size: 2.5rem; margin-bottom: 30px;">Experience</h2>
        <div class="timeline">
            <?php if ($experiences): ?>
                <?php foreach ($experiences as $exp): ?>
                    <div class="timeline-item" style="padding: 20px; background: var(--card-bg); border-radius: 15px; margin-bottom: 20px; border-left: 4px solid var(--primary-color);">
                        <h3 style="color: var(--primary-color);"><?php echo $exp['title']; ?></h3>
                        <p style="font-weight: 600;"><?php echo $exp['company']; ?> | <span style="color: var(--text-muted);"><?php echo $exp['duration']; ?></span></p>
                        <p style="margin-top: 10px;"><?php echo $exp['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No experience history added yet.</p>
            <?php f endif; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

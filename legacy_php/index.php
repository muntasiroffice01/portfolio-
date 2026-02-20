<?php
// index.php
include 'includes/header.php';
?>

<main>
    <section class="hero">
        <div class="container hero-content animate">
            <h1>Hi, I'm <span style="background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">John Doe</span></h1>
            <p>Full-Stack Developer | Designer | Tech Enthusiast</p>
            <div class="hero-btns">
                <a href="projects.php" class="btn btn-primary">View My Work</a>
                <a href="assets/cv.pdf" class="btn" style="border: 1px solid var(--primary-color);">Download CV</a>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

<?php
// contact.php
include 'includes/header.php';

$message_sent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $message = sanitize($_POST['message']);

    if ($name && $email && $message) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $message])) {
            $message_sent = true;
        } else {
            $error = "Something went wrong. Please try again later.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<main class="container" style="padding-top: 100px;">
    <section class="contact-section animate" style="max-width: 600px; margin: 0 auto;">
        <h2 style="font-size: 2.5rem; margin-bottom: 30px; text-align: center;">Get In Touch</h2>
        <p style="text-align: center; color: var(--text-muted); margin-bottom: 40px;">
            Have a project in mind or just want to say hi? Feel free to drop a message!
        </p>

        <?php if ($message_sent): ?>
            <div style="background: rgba(0, 210, 255, 0.1); color: var(--primary-color); padding: 20px; border-radius: 10px; margin-bottom: 30px; text-align: center;">
                <i class="fas fa-check-circle"></i> Message sent successfully! I'll get back to you soon.
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div style="background: rgba(255, 0, 0, 0.1); color: #ff4d4d; padding: 20px; border-radius: 10px; margin-bottom: 30px; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="contact.php" method="POST" style="background: var(--card-bg); padding: 40px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05);">
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px; font-weight: 600;">Your Name</label>
                <input type="text" name="name" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px; font-weight: 600;">Email Address</label>
                <input type="email" name="email" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
            </div>
            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 10px; font-weight: 600;">Message</label>
                <textarea name="message" rows="5" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white; resize: vertical;"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
        </form>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

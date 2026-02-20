<?php
// admin/manage-experience.php
include 'header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM experiences WHERE id = ?");
    $stmt->execute([$id]);
    redirect('manage-experience.php', 'Experience deleted successfully!');
}

// Handle Add/Edit
$edit_mode = false;
$exp = ['title' => '', 'company' => '', 'duration' => '', 'description' => ''];

if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM experiences WHERE id = ?");
    $stmt->execute([$id]);
    $exp = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title']);
    $company = sanitize($_POST['company']);
    $duration = sanitize($_POST['duration']);
    $description = sanitize($_POST['description']);

    if ($edit_mode) {
        $stmt = $pdo->prepare("UPDATE experiences SET title = ?, company = ?, duration = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $company, $duration, $description, $_GET['edit']]);
        redirect('manage-experience.php', 'Experience updated successfully!');
    } else {
        $stmt = $pdo->prepare("INSERT INTO experiences (title, company, duration, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $company, $duration, $description]);
        redirect('manage-experience.php', 'Experience added successfully!');
    }
}

$experiences = $pdo->query("SELECT * FROM experiences ORDER BY id DESC")->fetchAll();
?>

<div class="animate">
    <h1 style="margin-bottom: 30px;"><?php echo $edit_mode ? 'Edit Experience' : 'Add New Experience'; ?></h1>
    
    <form action="" method="POST" style="background: var(--card-bg); padding: 30px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05); margin-bottom: 40px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">Role Title</label>
                <input type="text" name="title" value="<?php echo $exp['title']; ?>" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">Company</label>
                <input type="text" name="company" value="<?php echo $exp['company']; ?>" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
            </div>
        </div>
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px;">Duration (e.g. 2020 - Present)</label>
            <input type="text" name="duration" value="<?php echo $exp['duration']; ?>" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
        </div>
        <div style="margin-bottom: 30px;">
            <label style="display: block; margin-bottom: 8px;">Description</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white; resize: vertical;"><?php echo $exp['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $edit_mode ? 'Update Experience' : 'Add Experience'; ?></button>
        <?php if ($edit_mode): ?>
            <a href="manage-experience.php" class="btn" style="border: 1px solid #444; margin-left: 10px;">Cancel</a>
        <?php endif; ?>
    </form>

    <h2 style="margin-bottom: 20px;">Experience History</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Company</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($experiences as $e): ?>
                <tr>
                    <td><?php echo $e['title']; ?></td>
                    <td><?php echo $e['company']; ?></td>
                    <td><?php echo $e['duration']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $e['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="?delete=<?php echo $e['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

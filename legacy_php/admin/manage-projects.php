<?php
// admin/manage-projects.php
include 'header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    redirect('manage-projects.php', 'Project deleted successfully!');
}

// Handle Add/Edit
$edit_mode = false;
$project = ['title' => '', 'description' => '', 'image' => '', 'tech_stack' => '', 'github_link' => '', 'live_demo' => ''];

if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title']);
    $description = sanitize($_POST['description']);
    $tech_stack = sanitize($_POST['tech_stack']);
    $github_link = sanitize($_POST['github_link']);
    $live_demo = sanitize($_POST['live_demo']);
    
    $image = $project['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/projects/' . $image);
    }

    if ($edit_mode) {
        $stmt = $pdo->prepare("UPDATE projects SET title = ?, description = ?, image = ?, tech_stack = ?, github_link = ?, live_demo = ? WHERE id = ?");
        $stmt->execute([$title, $description, $image, $tech_stack, $github_link, $live_demo, $_GET['edit']]);
        redirect('manage-projects.php', 'Project updated successfully!');
    } else {
        $stmt = $pdo->prepare("INSERT INTO projects (title, description, image, tech_stack, github_link, live_demo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $image, $tech_stack, $github_link, $live_demo]);
        redirect('manage-projects.php', 'Project added successfully!');
    }
}

$projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll();
?>

<div class="animate">
    <h1 style="margin-bottom: 30px;"><?php echo $edit_mode ? 'Edit Project' : 'Add New Project'; ?></h1>
    
    <form action="" method="POST" enctype="multipart/form-data" style="background: var(--card-bg); padding: 30px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05); margin-bottom: 40px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">Title</label>
                <input type="text" name="title" value="<?php echo $project['title']; ?>" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">Tech Stack</label>
                <input type="text" name="tech_stack" value="<?php echo $project['tech_stack']; ?>" placeholder="e.g. PHP, MySQL, React" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
            </div>
        </div>
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px;">Description</label>
            <textarea name="description" rows="4" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white; resize: vertical;"><?php echo $project['description']; ?></textarea>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">GitHub Link</label>
                <input type="url" name="github_link" value="<?php echo $project['github_link']; ?>" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">Live Demo Link</label>
                <input type="url" name="live_demo" value="<?php echo $project['live_demo']; ?>" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
            </div>
        </div>
        <div style="margin-bottom: 30px;">
            <label style="display: block; margin-bottom: 8px;">Project Image</label>
            <input type="file" name="image" <?php echo $edit_mode ? '' : 'required'; ?> style="width: 100%; padding: 10px;">
            <?php if ($project['image']): ?>
                <p style="margin-top: 10px; font-size: 0.8rem; color: var(--text-muted);">Current: <?php echo $project['image']; ?></p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $edit_mode ? 'Update Project' : 'Add Project'; ?></button>
        <?php if ($edit_mode): ?>
            <a href="manage-projects.php" class="btn" style="border: 1px solid #444; margin-left: 10px;">Cancel</a>
        <?php endif; ?>
    </form>

    <h2 style="margin-bottom: 20px;">Existing Projects</h2>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Stack</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $p): ?>
                <tr>
                    <td><img src="../assets/images/projects/<?php echo $p['image']; ?>" width="50" style="border-radius: 5px;"></td>
                    <td><?php echo $p['title']; ?></td>
                    <td><?php echo $p['tech_stack']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $p['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="?delete=<?php echo $p['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

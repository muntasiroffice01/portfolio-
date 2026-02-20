<?php
// admin/manage-blogs.php
include 'header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    redirect('manage-blogs.php', 'Blog post deleted successfully!');
}

// Handle Add/Edit
$edit_mode = false;
$blog = ['title' => '', 'content' => '', 'short_description' => '', 'category' => '', 'image' => ''];

if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    $blog = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title']);
    $content = sanitize($_POST['content']);
    $short_description = sanitize($_POST['short_description']);
    $category = sanitize($_POST['category']);
    $slug = slugify($title);
    
    $image = $blog['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . $_FILES['image']['name'];
        if (!is_dir('../assets/images/blog')) mkdir('../assets/images/blog');
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/blog/' . $image);
    }

    if ($edit_mode) {
        $stmt = $pdo->prepare("UPDATE blogs SET title = ?, slug = ?, content = ?, short_description = ?, category = ?, image = ? WHERE id = ?");
        $stmt->execute([$title, $slug, $content, $short_description, $category, $image, $_GET['edit']]);
        redirect('manage-blogs.php', 'Blog updated successfully!');
    } else {
        $stmt = $pdo->prepare("INSERT INTO blogs (title, slug, content, short_description, category, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $slug, $content, $short_description, $category, $image]);
        redirect('manage-blogs.php', 'Blog added successfully!');
    }
}

$blogs = $pdo->query("SELECT * FROM blogs ORDER BY id DESC")->fetchAll();
?>

<div class="animate">
    <h1 style="margin-bottom: 30px;"><?php echo $edit_mode ? 'Edit Blog Post' : 'Add New Blog'; ?></h1>
    
    <form action="" method="POST" enctype="multipart/form-data" style="background: var(--card-bg); padding: 30px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05); margin-bottom: 40px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">Title</label>
                <input type="text" name="title" value="<?php echo $blog['title']; ?>" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">Category</label>
                <input type="text" name="category" value="<?php echo $blog['category']; ?>" placeholder="e.g. Technology, Design" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
            </div>
        </div>
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px;">Short Description</label>
            <input type="text" name="short_description" value="<?php echo $blog['short_description']; ?>" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white;">
        </div>
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px;">Content</label>
            <textarea name="content" rows="10" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: #0b0e11; color: white; resize: vertical;"><?php echo $blog['content']; ?></textarea>
        </div>
        <div style="margin-bottom: 30px;">
            <label style="display: block; margin-bottom: 8px;">Blog Image</label>
            <input type="file" name="image" style="width: 100%; padding: 10px;">
            <?php if ($blog['image']): ?>
                <p style="margin-top: 10px; font-size: 0.8rem; color: var(--text-muted);">Current: <?php echo $blog['image']; ?></p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $edit_mode ? 'Update Blog' : 'Add Blog'; ?></button>
        <?php if ($edit_mode): ?>
            <a href="manage-blogs.php" class="btn" style="border: 1px solid #444; margin-left: 10px;">Cancel</a>
        <?php endif; ?>
    </form>

    <h2 style="margin-bottom: 20px;">Published Blogs</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogs as $b): ?>
                <tr>
                    <td><?php echo $b['title']; ?></td>
                    <td><?php echo $b['category']; ?></td>
                    <td><?php echo formatDate($b['created_at']); ?></td>
                    <td>
                        <a href="?edit=<?php echo $b['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="?delete=<?php echo $b['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

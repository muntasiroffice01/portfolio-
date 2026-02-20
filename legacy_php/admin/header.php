<?php
// admin/header.php
require_once '../config.php';
require_once '../includes/functions.php';
session_start();

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Portfolio</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-layout {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }
        .sidebar {
            background: var(--card-bg);
            border-right: 1px solid rgba(255,255,255,0.05);
            padding: 30px 20px;
        }
        .sidebar h2 {
            margin-bottom: 40px;
            text-align: center;
        }
        .sidebar ul li {
            margin-bottom: 15px;
        }
        .sidebar ul li a {
            display: block;
            padding: 12px 20px;
            border-radius: 10px;
            transition: 0.3s;
        }
        .sidebar ul li a:hover, .sidebar ul li a.active {
            background: rgba(0, 210, 255, 0.1);
            color: var(--primary-color);
        }
        .admin-main {
            padding: 40px;
            overflow-y: auto;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.05);
            text-align: center;
        }
        .stat-card h3 {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 10px;
        }
        .stat-card p {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-color);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
        }
        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        th {
            background: rgba(255,255,255,0.02);
            font-weight: 600;
        }
        .btn-sm {
            padding: 5px 12px;
            font-size: 0.85rem;
        }
        .btn-danger {
            background: #ff4d4d;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <h2 class="logo">ADMIN</h2>
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="manage-projects.php"><i class="fas fa-project-diagram"></i> Projects</a></li>
                <li><a href="manage-blogs.php"><i class="fas fa-blog"></i> Blogs</a></li>
                <li><a href="manage-experience.php"><i class="fas fa-briefcase"></i> Experience</a></li>
                <li><a href="messages.php"><i class="fas fa-envelope"></i> Messages</a></li>
                <li style="margin-top: 50px;"><a href="logout.php" style="color: #ff4d4d;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        <main class="admin-main">

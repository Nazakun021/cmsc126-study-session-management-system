<?php
require_once __DIR__ . '/../config/init.php';
requireLogin();
require_once __DIR__ . '/../config/db_connection.php';
// Load models
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/CourseModel.php';
global $pdo;

// Get user info
$userModel = new \App\Models\User($pdo);
$courseModel = new \App\Models\CourseModel($pdo);

$currentUser = getCurrentUser();
$user = $userModel->getUserById($currentUser['userId']);
$courseName = '';
if ($user && !empty($user['courseID'])) {
    $courseResult = $courseModel->getCourseById($user['courseID']);
    if ($courseResult && isset($courseResult['success']) && $courseResult['success']) {
        $courseName = $courseResult['course']['courseName'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <link rel="stylesheet" href="/cmsc126-study-session-management-system/public/css/styles.css">
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
  <div class="app-container">
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h1 class="app-title">ReviewApp</h1>
            <button id="menu-toggle" class="menu-toggle">
                <i data-feather="menu"></i>
            </button>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="/cmsc126-study-session-management-system/app/views/dashboard.php">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/cmsc126-study-session-management-system/app/views/review-sessions.php">
                        <i data-feather="calendar"></i>
                        <span>Review Sessions</span>
                    </a>
                </li>
                <!-- Remove Subjects and Attendance links from sidebar -->
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <h2>My Profile</h2>
            </div>
            <div class="header-right">
                <div class="dropdown">
                    <button class="dropdown-toggle">
                        <div class="user-avatar"><?php echo strtoupper(substr(htmlspecialchars($user['userName'] ?? ''), 0, 2)); ?></div>
                        <span class="user-name"><?php echo htmlspecialchars($user['userName'] ?? ''); ?></span>
                        <i data-feather="chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="/cmsc126-study-session-management-system/app/views/profile.php" class="dropdown-item">Profile</a>
                        <a href="/cmsc126-study-session-management-system/app/views/logout.php" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Profile Content -->
        <div class="content-container">
            <div class="profile-card">
                <div class="profile-item">
                    <div class="label">Username</div>
                    <div class="value"><?php echo htmlspecialchars($user['userName'] ?? ''); ?></div>
                </div>

                <div class="profile-item">
                    <div class="label">Email Address</div>
                    <div class="value"><?php echo htmlspecialchars($user['email'] ?? ''); ?></div>
                </div>

                <div class="profile-item">
                    <div class="label">Course</div>
                    <div class="value"><?php echo htmlspecialchars($courseName); ?></div>
                </div>
            </div>
        </div>
    </main>
  </div>

  <script src="/cmsc126-study-session-management-system/public/js/script.js"></script>
</body>
</html>

<?php
if (!headers_sent()) {
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");
    header("Referrer-Policy: strict-origin-when-cross-origin");
}
$site_title = "Pakistan Student Toolkit";
$base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= isset($title) ? htmlspecialchars($title).' | ' : '' ?><?= $site_title ?></title>
  <meta name="description" content="Free calculators for students in Pakistan: GPA/CGPA, Zakat, fee installment, merit estimator, grade target planner, and more."/>
  <link rel="stylesheet" href="<?= $base_url ?>/assets/style.css?v=1.0"/>
  <link rel="icon" href="<?= $base_url ?>/assets/logo.svg"/>
</head>
<body>
<header class="site-header">
  <div class="container nav">
    <a class="brand" href="<?= $base_url ?>/index.php">
      <img src="<?= $base_url ?>/assets/logo.svg" alt="" width="28" height="28"/>
      <span>Pakistan Student Toolkit</span>
    </a>
    <nav>
      <a href="<?= $base_url ?>/index.php">Home</a>
      <a href="<?= $base_url ?>/calculators.php">Calculators</a>
      <a href="<?= $base_url ?>/scholarships.php">Scholarships</a>
      <a href="<?= $base_url ?>/blog.php">Blog</a>
      <a class="btn" href="<?= $base_url ?>/contact.php">Contact</a>
    </nav>
  </div>
</header>
<main class="container">

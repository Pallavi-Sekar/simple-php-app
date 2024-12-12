<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <header>
    <div class="header">
      <h1>Skill Competition Registeration</h1>
    </div>
    <div class="navigations">
      <a href="./login.php">Login</a>
      <a href="./index.php">Student Registeration</a>
      <a href="./students.php">Students Registered</a>
      <a href="./logout.php">Logout</a>
    </div>
    <?php
    $welcomeName = 'User';
    if (!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
      $welcomeName = $_SESSION['username'];
    }

    ?>
    <p style="color: green; text-align: center;">Welcome <?php echo $welcomeName; ?>!</p>

  </header>
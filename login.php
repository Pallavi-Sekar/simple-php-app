<?php
session_start();
include('includes/header.php');
// if the form has been submitted, only then process the form data
if (!empty($_POST)) {
  // fetch data
  $username = $_POST['username'];
  $password = $_POST['password'];
  // validate: do it yourself, check if username or password is blank or 
  // if you want to go a step further use regex

  // processing
  if (empty($username))
    $message .= "Please enter username to proceed.<br>";
  if (empty($password))
    $message .= "Please enter password to proceed.<br>";
  if (!$message) {
    include('includes/database.php');

    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    // build SQL query
    $sqlQuery = "SELECT * FROM `users` WHERE `username` LIKE '$username' AND `password` LIKE '$password'";
    // run SQL query
    $userResult = $conn->query($sqlQuery);
    //print_r($userResult);

    if ($userResult->num_rows >= 1) {
      $user = $userResult->fetch_assoc();
      // this means the user has given us right username and password
      //echo 'found user';
      $_SESSION['user'] = $user['username'];
      $_SESSION['role'] = $user['type'];
      $_SESSION['username'] = $username;
      $_SESSION['logged_in'] = true;
      // fetch data from $userResult and put the 'type' in $_SESSION - do it yourself
      $message = 'You have successfully logged in';
      // header('Location: orders.php');
    } else {
      $message = 'Incorrect username or password. Please try again.';
    }
  }


}
?>

<main>

  <form name="loginform" class="loginForm" method="POST" action="">
    <h3>Login</h3>

    <div class="form-group">

      <label for="username">Username:</label>
      <input type="text" id="username" name="username">
      <br>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">
      <br>
    </div>

    <?php if ($message): ?>
      <div class="message">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>
    <br>


    <button type="submit" name="submit">Login</button><br><br>
  </form>





</main>



<?php
include("./includes/footer.php");
?>
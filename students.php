<?php
session_start();
if (!(!empty($_SESSION['logged_in']) && ($_SESSION['role'] == 'admin'))) {
  // user is not logged in, send them to login page
  header('Location: login.php');
}

include("./includes/header.php");
?>

<main>
  <table class="ordersTable">
    <thead>
      <tr>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>College Name</th>
        <th>College Address</th>
        <th>College City</th>
        <th>College Province</th>
        <th>Project Ttile</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include('includes/database.php');
      // build query
      $sqlQuery = "SELECT * FROM students";
      // execute query
      $ordersResult = $conn->query($sqlQuery);
      while ($order = $ordersResult->fetch_assoc()) {
        //print_r($order);
        ?>
        <tr>
          <td><?php echo $order['id']; ?></td>
          <td><?php echo $order['student_name']; ?></td>
          <td><?php echo $order['college_name']; ?></td>
          <td><?php echo $order['college_address']; ?></td>
          <td><?php echo $order['college_city']; ?></td>
          <td><?php echo $order['college_province']; ?></td>
          <td><?php echo $order['project_title']; ?></td>
          <td><?php echo $order['email']; ?></td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</main>

<?php
include("./includes/footer.php");
?>
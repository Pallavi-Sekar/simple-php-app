<?php
session_start();
include('includes/database.php');

$provinces = [
    'Ontario',
    'Quebec',
    'Alberta',
    'British Columbia',
    'Manitoba',
    'Newfoundland and Labrador',
    'Nova Scotia',
    'New Brunswick',
    'Prince Edward Island',
    'Saskatchewan'
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $collegeName = trim($_POST['collegeName']);
    $collegeAddress = trim($_POST['collegeAddress']);
    $collegeCity = trim($_POST['collegeCity']);
    $projectTitle = trim($_POST['projectTitle']);
    $email = trim($_POST['email']);
    $province = trim($_POST['province']);

    // Validate inputs
    $errors = '';
    if (empty($name))
        $errors .= 'Name is required.<br>';
    if (empty($collegeName))
        $errors .= 'Valid college name is required.<br>';
    if (empty($collegeAddress))
        $errors .= 'Valid college address is required.<br>';
    if (empty($collegeCity))
        $errors .= 'Valid college city is required.<br>';
    if (empty($projectTitle))
        $errors .= 'Valid project title is required.<br>';
    if (empty($province))
        $errors .= 'Valid province is required.<br>';
    if (empty($email))
        $errors .= 'Valid email is required.<br>';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors .= 'Invalid email format.';
    }
    
    if (empty($errors)) {
        $name = $conn->real_escape_string($name);
        $collegeName = $conn->real_escape_string($collegeName);
        $collegeAddress = $conn->real_escape_string($collegeAddress);
        $collegeCity = $conn->real_escape_string($collegeCity);
        $projectTitle = $conn->real_escape_string($projectTitle);
        $email = $conn->real_escape_string($email);
        $province = $conn->real_escape_string($province);
        $sqlQuery = "INSERT INTO `students` (`id`, `student_name`, `college_name`, `college_address`, `college_city`, `college_province`, `project_title`, `email`) VALUES (NULL, '$name', '$collegeName', '$collegeAddress', '$collegeCity', '$province', '$projectTitle', '$email');";
        $conn->query($sqlQuery);
        $receipt = "
        <h3>Registered Student Details</h3>
        <p><strong>Name:</strong> $name</p>
        <p><strong>College Name:</strong> $collegeName</p>
        <p><strong>College Adress:</strong> $collegeAddress</p>
        <p><strong>College City:</strong> $collegeCity </p>
        <p><strong>Project Title:</strong> $projectTitle</p>
        <p><strong>Email:</strong> $email</p>
         <p><strong>Province:</strong> $province</p>";
    } else {
        $receipt = $errors;
    }
}



include("./includes/header.php");
?>
<main>
    <form class="orderForm" name="orderForm" action="" method="POST">
        <div class="form-group">
            <label for="name">Student Name:</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="collegeName">College Name:</label>
            <input type="text" id="collegeName" name="collegeName">
        </div>

        <div class="form-group">
            <label for="collegeAddress">College Address:</label>
            <input type="text" id="collegeAddress" name="collegeAddress">
        </div>

        <div class="form-group">
            <label for="collegeCity">College City:</label>
            <input type="text" id="collegeCity" name="collegeCity">
        </div>

        <div class="form-group">
            <label for="projectTitle">Project Title:</label>
            <input type="text" id="projectTitle" name="projectTitle">
        </div>

        <div class="form-group">
            <label for="province">College Province:</label>
            <select id="province" name="province">
                <option value="">-- Select a Province --</option>
                <?php foreach ($provinces as $province): ?>
                    <option value="<?= $province ?>"><?= $province ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
        </div>

        <?php if ($receipt): ?>
            <div class="receipt">
                <?php echo $receipt; ?>
            </div>
        <?php endif; ?>


        <button type="submit">Register</button>
    </form>
</main>
<?php
include("./includes/footer.php");
?>
<?php
include 'connect.php';
include 'includes/header.php';
include 'includes/nav.php';

$successMessage = '';
$errorMessages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize
    $prefer_job = trim($_POST['prefer_job'] ?? '');
    $first_name = trim($_POST['first_name'] ?? '');
    $middle_name = trim($_POST['middle_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $birthday = trim($_POST['birthday'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validation
    if ($prefer_job == '') $errorMessages[] = "Job position is required.";
    if ($first_name == '') $errorMessages[] = "First name is required.";
    if ($last_name == '') $errorMessages[] = "Last name is required.";
    if ($birthday == '') $errorMessages[] = "Date of birth is required.";
    if ($gender == '') $errorMessages[] = "Gender is required.";
    if ($email == '') $errorMessages[] = "Email address is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errorMessages[] = "Invalid email format.";
    if ($phone == '') $errorMessages[] = "Phone number is required.";
    if (!preg_match("/^\d{11}$/", $phone)) $errorMessages[] = "Phone number must be 11 digits.";
    if ($address == '') $errorMessages[] = "Address is required.";
    if ($password == '') $errorMessages[] = "Password is required.";
    if (strlen($password) < 6) $errorMessages[] = "Password must be at least 6 characters.";

    // Check if email already exists
    if (empty($errorMessages)) {
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM job_seeker WHERE email = :email");
            $stmt->execute([':email' => $email]);
            if ($stmt->fetchColumn() > 0) {
                $errorMessages[] = "This email is already registered.";
            }
        } catch (PDOException $e) {
            error_log("Email check error: " . $e->getMessage());
            $errorMessages[] = "Something went wrong. Please try again later.";
        }
    }

    // Insert into DB
    if (empty($errorMessages)) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("
                INSERT INTO job_seeker 
                (prefer_job, first_name, middle_name, last_name, birthday, gender, email, phone, address, password, date) 
                VALUES 
                (:prefer_job, :first_name, :middle_name, :last_name, :birthday, :gender, :email, :phone, :address, :password, NOW())
            ");
            $stmt->execute([
                ':prefer_job' => $prefer_job,
                ':first_name' => $first_name,
                ':middle_name' => $middle_name,
                ':last_name' => $last_name,
                ':birthday' => $birthday,
                ':gender' => $gender,
                ':email' => $email,
                ':phone' => $phone,
                ':address' => $address,
                ':password' => $hashedPassword
            ]);
            $successMessage = "Registration successful!";
        } catch (PDOException $e) {
            error_log("Database insert error: " . $e->getMessage());
            $errorMessages[] = "Something went wrong. Please try again later.";
        }
    }
}
?>
<body>
  <div class="main-content">
    <div class="company-content">

        <?php if (!empty($successMessage)): ?>
            <div class="success"><?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>

        <?php foreach ($errorMessages as $error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>

        <form action="register.php" method="POST">
            <div class="form-container">
                <h3 class="index-form">Quick registration</h3>

                <div class="form-group-container">
                <select name="prefer_job">
                    <option value="">Select your desired Job Position:</option>
                    <option value="Deck Officer">Deck Officer</option>
                    <option value="Engine Officer">Engine Officer</option>
                    <!-- Add more options here -->
                </select>
                </div>

                <div class="form-row">
                <div class="col form-group-container">
                    <label>First name</label>
                    <input type="text" name="first_name" placeholder="Juan">
                </div>
                <div class="col form-group-container">
                    <label>Middle name</label>
                    <input type="text" name="middle_name" placeholder="Dela">
                </div>
                <div class="col form-group-container">
                    <label>Last name</label>
                    <input type="text" name="last_name" placeholder="Cruz">
                </div>
                </div>

                <div class="form-row">
                <div class="col form-group-container">
                    <label>Date of Birth</label>
                    <input type="date" name="birthday">
                </div>
                <div class="col form-group-container">
                    <label>Gender</label>
                    <select name="gender">
                    <option value="">-Select Gender-</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col form-group-container">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="example@mail.com">
                </div>
                <div class="col form-group-container">
                    <label>Phone</label>
                    <input type="tel" name="phone" placeholder="11 digits">
                </div>
                </div>

                <div class="form-group-container">
                <label>Address</label>
                <input type="text" name="address" placeholder="Dian street, Makati City.">
                </div>

                <div class="form-group-container">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password">
                </div>

                <div class="form-group-container form-btn">
                <button class="btn-register" type="submit">Register</button>
                </div>
            </div>
        </form>
    </div>

    <?php include 'includes/aside.php' ?>
  </div>
</body>
<?php include 'includes/footer.php' ?>

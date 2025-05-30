<?php
ob_start();
session_start();

include 'includes/dbh.inc.php';  
include 'includes/header.php';
include 'includes/nav.php';

$successMessage = $_SESSION['successMessage'] ?? '';
unset($_SESSION['successMessage']);

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

    // Validation
    if ($prefer_job === '') {
        $errorMessages[] = "Job position is required.";
    }
    if ($first_name == '') $errorMessages[] = "First name is required.";
    if ($last_name == '') $errorMessages[] = "Last name is required.";
    if ($birthday == '') $errorMessages[] = "Date of birth is required.";
    if ($gender == '') $errorMessages[] = "Gender is required.";
    if ($email == '') $errorMessages[] = "Email address is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errorMessages[] = "Invalid email format.";
    if ($phone == '') $errorMessages[] = "Phone number is required.";
    if (!preg_match("/^\d{11}$/", $phone)) $errorMessages[] = "Phone number must be 11 digits.";
    if ($address == '') $errorMessages[] = "Address is required.";

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

    // Insert into database
    if (empty($errorMessages)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO job_seeker 
                (prefer_job, first_name, middle_name, last_name, birthday, gender, email, phone, address, date) 
                VALUES 
                (:prefer_job, :first_name, :middle_name, :last_name, :birthday, :gender, :email, :phone, :address, NOW())
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
                ':address' => $address
            ]);

            $_SESSION['successMessage'] = "Data has been successfully inserted into job_seeker!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } catch (PDOException $e) {
            error_log("Database insert error: " . $e->getMessage());
            $errorMessages[] = "Something went wrong. Please try again later.";
        }
    }
}
?>
<body>
    <?php if (!empty($errorMessages)): ?>
        <div id="errorPopup" class="popup-overlay">
            <div class="popup-content">
                <span class="popup-close" onclick="closePopup('errorPopup')">&times;</span>
                <h2>Error</h2>
                <p id="errorMessage"><?= implode("<br>", array_map('htmlspecialchars', $errorMessages)); ?></p>
                <button onclick="closePopup('errorPopup')">Close</button>
            </div>
        </div>
    <?php elseif (!empty($successMessage)): ?>
        <div id="successPopup" class="popup-overlay">
            <div class="popup-content">
                <span class="popup-close" onclick="closePopup('successPopup')">&times;</span>
                <h2>Success</h2>
                <p><?= htmlspecialchars($successMessage) ?></p>
                <button onclick="closePopup('successPopup')">Close</button>
            </div>
        </div>
    <?php endif; ?>

  <div class="main-content">
    <div class="company-content">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-container">
                <h3 class="index-form">Quick registration</h3>

                <div class="form-group-container">
                    <label for="prefer_job">Desired Job Position</label>
                    <select name="prefer_job" id="prefer_job" class="js-job-select" style="width: 100%;">
                        <option value="">Select or type a position</option>
                        <?php
                        try {
                            $stmt = $pdo->query("SELECT DISTINCT prefer_job FROM job_seeker WHERE prefer_job IS NOT NULL AND prefer_job != '' ORDER BY prefer_job ASC");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $job = htmlspecialchars($row['prefer_job']);
                                echo "<option value=\"$job\">$job</option>";
                            }
                        } catch (PDOException $e) {
                            error_log("Error loading job options: " . $e->getMessage());
                        }
                        ?>
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

                <div class="form-group-container form-btn">
                <button class="btn-register" type="submit">Quick Apply</button>
                </div>
            </div>
        </form>
    </div>

    <?php include 'includes/aside.php' ?>
  </div>
</body>
<script src="js/popup.js"></script>
<script>
$(document).ready(function() {
  $('.js-job-select').select2({
    placeholder: "Select or type a position",
    tags: true,
    allowClear: true
  });
});
</script>
<?php include 'includes/footer.php' ?>

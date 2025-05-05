<div class="side-content">

    <form action="seaman_login_verify.php" method="post" name="seaman" id="seaman" onsubmit="return validateForm_seaman()">

      <div class="employer">
        <!--container seaman and employer log in-->
        <div class="category">
          <strong>Seaman Login</strong>
          <div class="input-fields">
            <label>Email: </label>
            <input class="side-input" name="job_seeker_id" id="job_seeker_id" type="text">
            <label>Password: </label>
            <input class="side-input" name="job_seeker_password" id="job_seeker_password" type="password">
            <button class="side-button" type="submit" value="Login" name="submit">Login</button>
            <a href="seaman_help.php">Forgot your Password?</a><br>
            <a href="add_seaman.php">Register Now</a>
          </div>
        </div>
      </div>
    </form>

    <div class="database">
      <div class="category">
        <strong>Database Records</strong>
        <?php
            include 'dbh.inc.php'; // Include your database connection file

            // Use the PDO connection
            $query = "SELECT * FROM pinoystats";
            $stmt = $pdo->query($query);

            if ($stmt) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    ?>
                    <div id="employer-data">
                        <strong><a href="seaman_list.php">Registered Seaman :</a> </strong> <span><?php echo $row["seaman"]; ?></span>
                        <strong><a href="company_list.php">Registered Company: </a> </strong> <span><?php echo $row["employer"]; ?></span><br>
                        <strong><a href="job_search.php">Job Posted: </a></strong> <span><?php echo $row["jobs"]; ?></span>
                    </div>
                    <?php
                } else {
                    echo "No records found in pinoystats table.";
                }
            } else {
                echo "Error executing query: " . $pdo->errorInfo();
            }
        ?>
      </div>
    </div>

    <div class="database">
        <div class="category">
            <strong>Newest Seaman member</strong>
            <?php
            include 'dbh.inc.php'; // Include your database connection file

            // Use the PDO connection
            $query = "SELECT first_name, last_name, prefer_job, date FROM job_seeker ORDER BY code DESC LIMIT 1";
            $stmt = $pdo->query($query);

            if ($stmt) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $name = ucwords(strtolower($row["first_name"]) . " " . strtolower($row["last_name"]));
                    $position = htmlspecialchars($row["prefer_job"], ENT_QUOTES, 'UTF-8');
                    $date_registered = htmlspecialchars($row["date"], ENT_QUOTES, 'UTF-8');
                } else {
                    $name = "No data available";
                    $position = "No data available";
                    $date_registered = "No data available";
                }
            } else {
                echo "Error executing query: " . $pdo->errorInfo();
            }

            ?>
        </div>
            <div class="data-record">
                <strong class="record-style">Name: </strong> <span><?php echo $name; ?></span><br>
                <strong class="record-style">Position: </strong> <span><?php echo $position; ?></span><br>
                <strong class="record-style">Date Registered: </strong> <span><?php echo $date_registered; ?></span>
            </div>
    </div>


    <div class="random-images">
        <div class="category">
          <strong>Random Images</strong>
        </div>
        <div class="image-container">
          <?php
          $folder = 'seaman_pics/';
          $images = glob($folder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
          if (!empty($images)) {
            $randomImage = $images[array_rand($images)];
          } else {
            $randomImage = 'bbbbbb.jpg';
          }
          ?>
          <img src="<?php echo htmlspecialchars($randomImage); ?>" alt="Random Image">
        </div>
    </div>


    <div class="submit-photo">
      <a href="">Submit a photo</a>
    </div>

    <div class="advertise">
      <strong>Advertisement</strong>
    </div>

    <a class="ads-container" href="https://www.facebook.com/groups/208236972851302/">
      <img src="images/yourads.jpg" alt="">
    </a>

    <a class="ads-container" href="https://www.facebook.com/groups/208236972851302/">
      <img src="images/yourads.jpg" alt="">
    </a>

    <a class="ads-container" href="https://www.facebook.com/groups/208236972851302/">
      <img src="images/yourads.jpg" alt="">
    </a>
    
</div>

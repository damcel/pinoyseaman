<?php
require_once 'connect.php';
include 'includes/header.php';
include 'includes/nav.php';
?>

<body>

    <div class="main-content">

        <div class="content">
            <div class="header-content">
                <table>
                    <thead>
                        <tr>
                        <th class="company">Manning Agency</th>
                        <th class="job-position">Vessel Type</th>
                        <th class="action">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="job-content">
                <?php
                // Retrieve data - default 0
                $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
                $rec_per_page = 11;

                // Connection
                $link = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname);
                if (!$link) {
                    die("Error connecting to the database: " . mysqli_connect_error());
                }

                // Safely escape datenow variable
                $datenow = mysqli_real_escape_string($link, $datenow);

                // Record ng jobs avail with title AB/COOK
                $count_query = "SELECT COUNT(*) AS total FROM jobs WHERE mark='y' AND job_title = 'ab/cook'";
                $count_result = mysqli_query($link, $count_query);
                if (!$count_result) {
                    die("Error fetching record count: " . mysqli_error($link));
                }
                $record_count = mysqli_fetch_assoc($count_result)['total'];
                $page = ceil($record_count / $rec_per_page);

                // Fetch paginated jobs with title AB/COOK (no expiry filter)
                $start = $offset * $rec_per_page;
                $query = "SELECT * FROM jobs WHERE mark='y' AND job_title = 'ab/cook' 
                 ORDER BY date_posted DESC LIMIT $start, $rec_per_page";
                $result = mysqli_query($link, $query);
                if (!$result) {
                    die("Error fetching jobs: " . mysqli_error($link));
                }

                // Display job rows
                while ($row = mysqli_fetch_assoc($result)) {
                    $company_name = isset($row["company_name"]) ? htmlspecialchars(str_replace(["^", "*"], ["'", "&"], $row["company_name"]), ENT_QUOTES, 'UTF-8') : '';
                    $vessel_type = isset($row["vessel_type"]) ? htmlspecialchars($row["vessel_type"], ENT_QUOTES, 'UTF-8') : '';
                    $job_code = isset($row["vessel_type"]) ? urlencode($row["vessel_type"]) : '';
                    $company_code = isset($row["company_code"]) ? urlencode($row["company_code"]) : '';
                ?>
                    <div class="row">
                        <div class="company-name"><?php echo $company_name; ?></div>
                        <div><?php echo $vessel_type; ?></div>
                        <div>
                            <a href="display_company2.php?company_code=<?php echo $company_code; ?>&code=<?php echo $job_code; ?>"
                                target="windowName"
                                onclick="window.open(this.href, this.target, 'width=800,height=500,scrollbars=yes'); return false;">
                                Apply Now
                            </a>
                        </div>
                    </div>
                <?php
                }
                mysqli_close($link);
                ?>

                <center>
                    <?php
                    // Pagination
                    echo "You are viewing page " . ($offset + 1) . " of $page"; ?>
                    <br />View Page &nbsp;
                    <?php
                    for ($i = 0; $i < $page; $i++) {
                        $label = $i + 1;
                        echo "&nbsp; <a href='job_search.php?offset=" . $i . "'>$label</a> |";
                    }
                    ?>
                </center>
            </div>

        </div>
        <?php include 'includes/asidev2.php' ?>
    </div>

</body>

<?php include 'includes/footer.php' ?>

<?php include 'header.php'; ?>

<!-- Display the message at the top of the page -->
<?php 
$message = ""; // Initialize message variable

if (isset($_POST['showbtn'])) {
    $conn = mysqli_connect("localhost", "root", "", "crud") or die("Connection failed");

    $stu_id = trim($_POST['sid']); // Trim whitespace

    if (empty($stu_id)) {
        // If ID is empty, set an error message
        $message = "<h3><p style='color: white; text-align: center; background-color: #3498db; padding: 10px;'>Please enter a valid student ID.</p></h3>";
    } else {
        $sql = "SELECT * FROM student WHERE sid = {$stu_id}";
        $result = mysqli_query($conn, $sql) or die("<h2 style='color: red; text-align: center;'>Query failed</h2>");

        if (mysqli_num_rows($result) > 0) {
            // Valid ID, continue below
        } else {
            // If the ID does not exist in the table, set an error message
            $message = "<h3><p style='color: white; text-align: center; background-color: #3498db; padding: 10px;'>This student does not exist.</p></h3>";
        }
    }
    mysqli_close($conn);
}

// Display the message at the top
if (!empty($message)) {
    echo "<div id='error-message'>$message</div>";
}
?>

<div id="main-content">
    <h2>Edit Record</h2>

    <form class="post-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label>Enter Id:</label>
            <input type="text" name="sid" />
        </div>
        <input class="submit" type="submit" name="showbtn" value="Show" />
    </form>

    <?php 
    if (isset($_POST['showbtn']) && empty($message)) {
        $conn = mysqli_connect("localhost", "root", "", "crud") or die("Connection failed");

        $stu_id = trim($_POST['sid']);
        $sql = "SELECT * FROM student WHERE sid = {$stu_id}";
        $result = mysqli_query($conn, $sql) or die("<h2 style='color: red; text-align: center;'>Query failed</h2>");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <form class="post-form" action="updatedata.php" method="post">
        <div class="form-group">
            <label for="">Name</label>
            <input type="hidden" name="sid" value="<?php echo $row['sid']; ?>" />
            <input type="text" name="sname" value="<?php echo $row['sname']; ?>" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="saddress" value="<?php echo $row['saddress']; ?>" />
        </div>
        <div class="form-group">
            <label>Class</label>
            <?php 
            $sql1 = "SELECT * FROM studentclass";
            $result1 = mysqli_query($conn, $sql1) or die("<h3 style='color: red; text-align: center;'>Class query failed</h3>");

            if (mysqli_num_rows($result1) > 0) {
                echo '<select name="sclass">';
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $select = ($row['sclass'] == $row1['cid']) ? "selected" : "";
                    echo "<option {$select} value='{$row1['cid']}'>{$row1['cname']}</option>";
                }
                echo "</select>";
            }
            ?>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sphone" value="<?php echo $row['sphone']; ?>" />
        </div>
        <input class="submit" type="submit" value="Update" />
    </form>

    <?php 
            }
        }
    }
    ?>
</div>

<div id="footer">
    Abhishek@copyright 08-08-2024.
</div>
</body>
</html>

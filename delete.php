<?php 
include 'header.php';  
if(isset($_POST['deletebtn'])){
    include "config.php";
    $stu_id = $_POST['sid'];
    
    if ($stu_id) {
        // Check if the student ID exists
        $check_sql = "SELECT * FROM student WHERE sid = {$stu_id}";
        $check_result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($check_result) > 0) {
            // If the ID exists, proceed to delete
            $sql = "DELETE FROM student WHERE sid = {$stu_id}";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                header("Location: http://localhost/crud-php/index.php");
            } else {
                echo "<h2><p align=center>Unable to delete record. Please try again.</p></h2>";
            }
        } else {
            // If the ID does not exist, show an error message
            echo "<h3><p style='color: white; text-align: center; background-color: #3498db; padding: 10px;'>This student does not exist.</p></h3>";
        }
    } else {
        echo "<h3><p style='color: white; text-align: center; background-color: #3498db; padding: 10px;'>Please enter a valid student ID.</p></h3>";

    }
    mysqli_close($conn);
}
?> 

<div id="main-content">
    <h2>Delete Record</h2>

    <form class="post-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label>Enter Id:</label>
            <input type="text" name="sid"/>
        </div>
        <input class="submit" type="submit" name="deletebtn" value="Delete" />
    </form>

</div> 

<div id="footer">
    Abhishek@copyright 08-08-2024.
</div>
 
</body>
</html>

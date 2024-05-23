<?php
include('Database_Connection.php');

// Check if ReportID is set
if(isset($_REQUEST['ReportID'])) {
    $rid = $_REQUEST['ReportID'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM reports WHERE ReportID=?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $report_id = $row['ReportID'];
        $user_id = $row['UserID'];
        $listing_id = $row['ListingID'];
        $timestamp = $row['Timestamp'];
        $reason = $row['Reason'];
    } else {
        echo "Report not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Reports Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update reports form -->
        <h2><u>Update Form for Reports</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">


            <label for="UserID">User ID:</label>
            <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
            <br><br>

            <label for="ListingID">Listing ID:</label>
            <input type="text" name="listing_id" value="<?php echo isset($listing_id) ? $listing_id : ''; ?>">
            <br><br>

            <label for="Timestamp">Timestamp:</label>
            <input type="datetime-local" name="timestamp" value="<?php echo isset($timestamp) ? $timestamp : ''; ?>">
            <br><br>

            <label for="Reason">Reason:</label>
            <input type="text" name="reason" value="<?php echo isset($reason) ? $reason : ''; ?>">
            <br><br>

            <input type="submit" name="update" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    // Retrieve updated values from form
    $report_id = $_POST['report_id'];
    $user_id = $_POST['user_id'];
    $listing_id = $_POST['listing_id'];
    $timestamp = $_POST['timestamp'];
    $reason = $_POST['reason'];
    
    // Update the report in the database
    $stmt = $connection->prepare("UPDATE reports SET UserID=?, ListingID=?, Timestamp=?, 
    Reason=? WHERE ReportID=?");
    $stmt->bind_param("sdsii", $user_id, $listing_id, $timestamp, $reason, $report_id);
    $stmt->execute();
    
    // Redirect to reports.php or any other appropriate page
    header('Location: view_reports.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

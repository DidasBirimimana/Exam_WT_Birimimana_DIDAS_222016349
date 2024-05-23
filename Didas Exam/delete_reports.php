<?php
include('Database_Connection.php');

// Check if ReportID is set
if(isset($_REQUEST['ReportID'])) {
    $reportID = $_REQUEST['ReportID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM reports WHERE ReportID=?");
    $stmt->bind_param("i", $reportID);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="reportID" value="<?php echo $reportID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='view_reports.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
    </body>
    </html>
    <?php
    $stmt->close();
} else {
    echo "ReportID is not set.";
}

$connection->close();
?>

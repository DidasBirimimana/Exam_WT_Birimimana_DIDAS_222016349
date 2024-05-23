<?php
include('Database_Connection.php');

// Check if AdID is set
if(isset($_REQUEST['AdID'])) {
    $adID = $_REQUEST['AdID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM ads WHERE AdID=?");
    $stmt->bind_param("i", $adID);
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
            <input type="hidden" name="adID" value="<?php echo $adID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='view_ads.php'>OK</a>";
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
    echo "AdID is not set.";
}

$connection->close();
?>

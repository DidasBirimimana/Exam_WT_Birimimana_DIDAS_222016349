<?php
include('Database_Connection.php');

// Check if ListingID is set
if(isset($_REQUEST['ListingID'])) {
    $listingID = $_REQUEST['ListingID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM listings WHERE ListingID=?");
    $stmt->bind_param("i", $listingID);
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
            <input type="hidden" name="listingID" value="<?php echo $listingID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='view_listings.php'>OK</a>";
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
    echo "ListingID is not set.";
}

$connection->close();
?>

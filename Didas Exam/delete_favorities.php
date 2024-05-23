<?php
include('Database_Connection.php');

// Check if UserID is set
if(isset($_REQUEST['UserID'])) {
    $userID = $_REQUEST['UserID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM favorites WHERE UserID=?");
    $stmt->bind_param("i", $userID);
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
            <input type="hidden" name="userID" value="<?php echo $userID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='view_favorites.php'>OK</a>";
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
    echo "UserID is not set.";
}

$connection->close();
?>

<?php
include('Database_Connection.php');

// Check if ImageID is set
if(isset($_REQUEST['ImageID'])) {
    $imgid = $_REQUEST['ImageID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM images WHERE ImageID=?");
    $stmt->bind_param("i", $imgid);
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
            <input type="hidden" name="imgid" value="<?php echo $imgid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='view_images.php'>OK</a>";
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
    echo "ImageID is not set.";
}

$connection->close();
?>

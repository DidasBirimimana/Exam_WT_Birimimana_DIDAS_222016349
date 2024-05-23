<?php
include 'Database_Connection.php';

$message = ''; // Initialize an empty message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    // Validate the email
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format";
    } elseif (strlen($Password) < 4) {
        // Validate the password length
        $message = "Password must be at least 4 characters long.";
    } else {
        // Update the user's password in the database using prepared statement
        $Password = password_hash($Password, PASSWORD_DEFAULT);
        $stmt = $connection->prepare("UPDATE users SET password=? WHERE email=?");
        $stmt->bind_param("ss", $Password, $Email);
        if ($stmt->execute()) {
            $message = "Password updated successfully. THANKS!";
        } else {
            $message = "Error updating password.";
        }

        $stmt->close(); // Close the prepared statement
    }
    echo $message;
    // Close the database connection
    $connection->close();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
</head>
<body>

<!-- Trigger button for the modal -->
<button id="resetBtn">Reset Password</button>

<div id="resetModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Reset Password</h2>
        <form id="resetForm" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">New Password:</label><br>
            <input type="password" id="password" name="password" required minlength="4"><br><br>
            
            <input style="color: black;" type="submit" value="Reset Password">
        </form>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById('resetModal');

    // Get the button that opens the modal
    var btn = document.getElementById('resetBtn');

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Prevent default form submission behavior and submit form using AJAX
    document.getElementById("resetForm").addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        fetch("", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            alert(result);
            modal.style.display = "none";
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>

</body>
</html>
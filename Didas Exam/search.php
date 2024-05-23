<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
  
  include('Database_Connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);
  
    // Queries for different tables
    $queries = [
        'reports' => "SELECT ReportID FROM reports WHERE ReportID LIKE '%$searchTerm%'",
        'payments' => "SELECT PaymentID FROM payments WHERE PaymentID LIKE '%$searchTerm%'",
        'messages' => "SELECT Content FROM messages WHERE Content LIKE '%$searchTerm%'",
        'instructors' => "SELECT InstructorID FROM instructors WHERE InstructorID LIKE '%$searchTerm%'",
        'images' => "SELECT ImageURL FROM images WHERE ImageURL LIKE '%$searchTerm%'",
        'feedback' => "SELECT Comments FROM feedback WHERE Comments LIKE '%$searchTerm%'",
        'favorites' => "SELECT UserID FROM favorites WHERE UserID LIKE '%$searchTerm%'",

        'categories' => "SELECT Name FROM categories WHERE Name LIKE '%$searchTerm%'",
        'ads' => "SELECT Title FROM ads WHERE Title LIKE '%$searchTerm%'",
        'listings' => "SELECT Title FROM listings WHERE Title LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>

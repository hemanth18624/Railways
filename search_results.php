<?php
session_start();

// Check if search results are available in session
if(isset($_SESSION['search_result'])) {
    $search_results = $_SESSION['search_result'];
    unset($_SESSION['search_result']); // Clear session variable

    // Display search results in a table structure
    echo ".<h2>Search Results</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Train ID</th><th>Train Name</th><th>Source</th><th>Destination</th><th>Date of Journey</th><th>General Price</th><th>Sleeper Price</th><th>AC Price</th><th>Distance</th><th>General Count</th><th>Sleeper Count</th><th>AC Count</th></tr>";
    foreach($search_results as $row) {
        echo "<tr>";
        echo "<td>".$row["train_id"]."</td>";
        echo "<td>".$row["train_name"]."</td>";
        echo "<td>".$row["source"]."</td>";
        echo "<td>".$row["destination"]."</td>";
        echo "<td>".$row["date_of_journey"]."</td>";
        echo "<td>".$row["gen_price"]."</td>";
        echo "<td>".$row["sleeper_price"]."</td>";
        echo "<td>".$row["ac_price"]."</td>";
        echo "<td>".$row["distance"]."</td>";
        echo "<td>".$row["gen_count"]."</td>";
        echo "<td>".$row["sleeper_count"]."</td>";
        echo "<td>".$row["ac_count"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Redirect to search_train.php if search results are not available
    header("Location: search_train.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <link rel = stylesheet href = "search_results.css">

    <button type = "submit" id = "bt">Book Ticket</button>
</body>
</html>

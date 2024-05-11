<?php
session_start();

if(!isset($_SESSION['Signin']) || $_SESSION['Signin'] !== true){
    header("Location: login.php");
    exit();
}

if(isset($_POST["search"]))
{
    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "test");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize user input to prevent SQL injection
    $source = mysqli_real_escape_string($conn, $_POST['from']);
    $destination = mysqli_real_escape_string($conn, $_POST['to']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    // Prepare SQL query
    $sql = "SELECT * FROM train_details WHERE source = '$source' AND destination = '$destination' AND date_of_journey = '$date'";

    // Execute SQL query
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Save the search results in an array
            $search_results = array();
            while($row = mysqli_fetch_assoc($result)) {
                $search_results[] = $row;
            }
            // Save the search results array in a session variable
            $_SESSION['search_result'] = $search_results;
            // Redirect to search_results.php
            header("Location: search_results.php");
            exit();
        } else {
            header("Location: display_no_results.php");
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Search</title>
    <link rel="stylesheet" href="search_train.css">
</head>
<body>
    .<h1>Train Search</h1>
    <hr>
    <form action="search_train.php" method="POST">
        <div class="box">
            <label for="from">From:</label>
            <input type="text" id="from" name="from" required>
            
            <label for="to" >To:</label>
            <input type="text" id="to" name="to" required>
            
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            
            <button type="submit" name="search">Search Trains</button>
        </div>
    </form>
</body>
</html>

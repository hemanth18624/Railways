<?php
session_start();

// Check if search results are available in session
if(isset($_SESSION['search_result'])) {
    $search_results = $_SESSION['search_result'];
    unset($_SESSION['search_result']); // Clear session variable

    // Display search results in a table structure
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Train Details</title>";
    echo "<style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-image: url('railway1.png');
                background-size: cover;
                background-repeat: no-repeat;
            }
            
            .container {
                width: 80%;
                margin: 20px auto;
                background-color: lightgrey;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            
            h2 {
                text-align: center;
                margin-bottom: 20px;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
            }
            
            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }
            
            th {
                background-color: #007bff;
                color: white;
            }
            
            button {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 8px 15px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                cursor: pointer;
                border-radius: 5px;
            }
        </style>";
    echo "</head>";
    echo "<body>";
    echo "<div class='container'>";
    echo "<h2>Search Results</h2>";
    echo "<table>";
    echo "<tr><th>Train ID</th><th>Train Name</th><th>Source</th><th>Destination</th><th>Date of Journey</th><th>General Price</th><th>Sleeper Price</th><th>AC Price</th><th>Distance</th><th>General Count</th><th>Sleeper Count</th><th>AC Count</th><th>Action</th></tr>";
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
        echo "<td><form action='enter_ticket_details.php' method='post'>";
        echo "<input type='hidden' name='train_id' value='".$row["train_id"]."'>";
        echo "<input type='hidden' name='train_name' value='".$row["train_name"]."'>";
        echo "<input type='hidden' name='source' value='".$row["source"]."'>";
        echo "<input type='hidden' name='destination' value='".$row["destination"]."'>";
        echo "<input type='hidden' name='date_of_journey' value='".$row["date_of_journey"]."'>";
        echo "<input type='hidden' name='gen_price' value='".$row["gen_price"]."'>";
        echo "<input type='hidden' name='sleeper_price' value='".$row["sleeper_price"]."'>";
        echo "<input type='hidden' name='ac_price' value='".$row["ac_price"]."'>";
        echo "<input type='hidden' name='distance' value='".$row["distance"]."'>";
        echo "<input type='hidden' name='gen_count' value='".$row["gen_count"]."'>";
        echo "<input type='hidden' name='sleeper_count' value='".$row["sleeper_count"]."'>";
        echo "<input type='hidden' name='ac_count' value='".$row["ac_count"]."'>";
        echo "<button type='submit' name='book_ticket'>Book Ticket</button>";
        echo "</form></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
} else {
    // Redirect to search_train.php if search results are not available
    header("Location: search_train.php");
    exit();
}
?>

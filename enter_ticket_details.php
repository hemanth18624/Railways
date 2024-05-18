<?php
session_start();

$insert = false;
if (isset($_POST['submit'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "test";

    $con = mysqli_connect($server, $username, $password, $database);

    // Check for connection success
    if (!$con) {
        die("Connection to the database failed due to: " . mysqli_connect_error());
    }

    // Collect post variables
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $berth_type = $_POST['berthType'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $no_of_tickets = $_POST['no_of_tickets'];
    $train_id = $_POST['train_id'];
    $train_name = $_POST['train_name'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $date_of_journey = $_POST['date_of_journey'];
    $gen_price = $_POST['gen_price'];
    $sleeper_price = $_POST['sleeper_price'];
    $ac_price = $_POST['ac_price'];
    $distance = $_POST['distance'];
    $gen_count = $_POST['gen_count'];
    $sleeper_count = $_POST['sleeper_count'];
    $ac_count = $_POST['ac_count'];
    
    switch ($berth_type) {
        case "general":
            $available_tickets = $gen_count;
            break;
        case "sleeper":
            $available_tickets = $sleeper_count;
            break;
        case "ac":
            $available_tickets = $ac_count;
            break;
    }

    if ($no_of_tickets > $available_tickets) {
        echo "<script>alert('Limited seats available on $berth_type.')</script>";
        exit();
    }

    // Generate a unique 5 digit number for pnr
    do {
        $pnr = rand(10000, 99999);
        $check_pnr_query = "SELECT pnr_no FROM passenger_details WHERE pnr_no = '$pnr'";
        $check_pnr_result = mysqli_query($con, $check_pnr_query);
    } while (mysqli_num_rows($check_pnr_result) > 0);

    // Write the sql query
    $sql = "INSERT INTO `passenger_details` (`pnr_no`, `name`, `age`, `gender`, `berth_type`, `phone_no`, `email`, `no_of_tickets`) VALUES ('$pnr', '$name', '$age', '$gender', '$berth_type', '$phone_no', '$email', '$no_of_tickets')";

    // Execute the query
    if ($con->query($sql) === true) {
        $insert = true;

        // Update available ticket counts in train_details table
        switch ($berth_type) {
            case "general":
                $update_query = "UPDATE train_details SET gen_count = gen_count - $no_of_tickets WHERE train_id = $train_id AND date_of_journey = '$date_of_journey' AND source = '$source' AND destination = '$destination'";
                break;
            case "sleeper":
                $update_query = "UPDATE train_details SET sleeper_count = sleeper_count - $no_of_tickets WHERE train_id = $train_id AND date_of_journey = '$date_of_journey' AND source = '$source' AND destination = '$destination'";
                break;
            case "ac":
                $update_query = "UPDATE train_details SET ac_count = ac_count - $no_of_tickets WHERE train_id = $train_id AND date_of_journey = '$date_of_journey' AND source = '$source' AND destination = '$destination'";
                break;
        }
        mysqli_query($con, $update_query);

        // Store data in session for generating QR code
        $_SESSION['ticket_details'] = [
            'name' => $name,
            'age' => $age,
            'gender' => $gender,
            'berthType' => $berth_type,
            'phone_no' => $phone_no,
            'email' => $email,
            'no_of_tickets' => $no_of_tickets,
            'train_id' => $train_id,
            'train_name' => $train_name,
            'source' => $source,
            'destination' => $destination,
            'date_of_journey' => $date_of_journey,
            'gen_price' => $gen_price,
            'sleeper_price' => $sleeper_price,
            'ac_price' => $ac_price,
            'distance' => $distance,
            'gen_count' => $gen_count,
            'sleeper_count' => $sleeper_count,
            'ac_count' => $ac_count
        ];

        // Redirect to generate_qr.php
        header("Location: generate_qr.php");
        exit();
    } else {
        echo "ERROR: $sql <br>" . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Information Form</title>
    <link rel="stylesheet" href="enter_ticket_details.css">
</head>
<body>
    <div class="heading">
        <h1>Passenger Information</h1>
    </div>
    <div class="container">
        <form action="enter_ticket_details.php" method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" placeholder="Enter your name" required><br><br>

            <label for="age">Age:</label><br>
            <input type="number" id="age" name="age" placeholder="Enter your Age" min="1" required><br><br>

            <label for="gender" style="display: block;">Gender:</label>
            <select id="gender" name="gender" required style="width: 100%; margin-bottom: 40px; border-radius: 5px; box-sizing: border-box; font-size: 16px; padding: 10px;">
                <option value="" disabled selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <label for="berthType" style="display: block;">Berth Type:</label>
            <select id="berthType" name="berthType" required style="width: 100%; padding: 10px; margin-bottom: 40px; border-radius: 5px; box-sizing: border-box; font-size: 16px;">
                <option value="" disabled selected>Select Berth Type</option>
                <option value="sleeper">Sleeper</option>
                <option value="general">General</option>
                <option value="ac">AC</option>
            </select>

            <label for="phone">Phone No:</label><br>
            <input type="tel" id="phone" name="phone_no" pattern="[0-9]{10}" placeholder="Enter Phone No" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" placeholder="Enter your Email" required><br><br>
            
            <label for="tickets">Number of Tickets:</label><br>
            <input type="number" id="tickets" placeholder="Enter number of tickets" required min="1" max="5" name="no_of_tickets"><br>

            <!-- Hidden input fields to pass train details -->
            <input type="hidden" name="train_id" value="<?php echo $_POST['train_id']; ?>">
            <input type="hidden" name="train_name" value="<?php echo $_POST['train_name']; ?>">
            <input type="hidden" name="source" value="<?php echo $_POST['source']; ?>">
            <input type="hidden" name="destination" value="<?php echo $_POST['destination']; ?>">
            <input type="hidden" name="date_of_journey" value="<?php echo $_POST['date_of_journey']; ?>">
            <input type="hidden" name="gen_price" value="<?php echo $_POST['gen_price']; ?>">
            <input type="hidden" name="sleeper_price" value="<?php echo $_POST['sleeper_price']; ?>">
            <input type="hidden" name="ac_price" value="<?php echo $_POST['ac_price']; ?>">
            <input type="hidden" name="distance" value="<?php echo $_POST['distance']; ?>">
            <input type="hidden" name="gen_count" value="<?php echo $_POST['gen_count']; ?>">
            <input type="hidden" name="sleeper_count" value="<?php echo $_POST['sleeper_count']; ?>">
            <input type="hidden" name="ac_count" value="<?php echo $_POST['ac_count']; ?>">

            <input type="submit" value="Submit" name="submit" class="bot">
        </form>
    </div>
</body>
</html>

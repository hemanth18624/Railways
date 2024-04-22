<?php
$insert = false;
if(isset($_POST['firstname'])){
 
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "test"; // Add the database name

    $con = mysqli_connect($server, $username, $password, $database);

    // Check for connection success
    if(!$con){
        die("Connection to the database failed due to: " . mysqli_connect_error());
    }

    // Collect post variables
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Corrected SQL query with backticks for column names
    $sql = "INSERT INTO `registration` (`firstname`, `lastname`, `username`, `password`, `age`, `gender`, `email`, `phone`) VALUES ('$firstname', '$lastname', '$username', '$password', '$age', '$gender', '$email', '$phone')";
    // Execute the query
    if($con->query($sql) === true){
        echo "Data inserted successfully.";
        $insert = true;
    } else{
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
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Register</title>
</head>
<body>
    <header>
        .<div class="title">
            <h1>Indian Railways</h1>
        </div>
        <hr>
        <div class="login-heading">
            <h2>Register Here!</h2>
        </div>
    </header>
    <div class="container">
        <form action = "register.php" method = "POST">
            <label for = "firstName">First Name*</label>    
            <input type="text" class = "firstname"placeholder = "Enter First Name" required name = "firstname">
            <label for = "lastName">Last Name*</label>
            <input type="text" class = "lastname" placeholder = "Enter Last Name" required name = "lastname">
            <label for = "userName">User Name*</label>
            <input type = "text" id = "User Name" placeholder = "Enter user name"required name = "username">
            <label for = "password">Create Password*</label>
            <input type = "password" id = "password" placeholder = "Create Password" required name = "password">
            <label for = "age">Age*</label>
            <input type = "number" id = "age" placeholder="Enter your Age"  required min = 0 name = "age">
            <label for ="gender" id = "gender">Gender*</label>
            <div class = "first">
                <input type="radio" class = "gender" id="male" value="male"  name = "gender"/>
                <label for="Male">Male</label>
                <input type="radio" class = "gender" id="Female" value="Female" name = "gender"/>
                <label for="Female">Female</label>
            </div>
            <label for = "email">Email ID*</label>
            <input type = "email" id = "Email" placeholder="Enter your Email"  required name = "email" >
            <label for ="phone">Phone Number*</label>
            <input type = "phone" id = "phone" placeholder="Enter your Phone Number"  required name = "phone" >
            <div class = "btn">
                <input type = "submit" value = "Sign Up" class = "bot">
            </div>
        </form>
    </div>    
</body>
</html>

<?php
session_start();

if(isset($_POST["submit"]))
{
    $conn = mysqli_connect("localhost", "root", "", "test");
    
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    
    $result = mysqli_query($conn, "SELECT * FROM registration WHERE username='$username'");
    $row = mysqli_fetch_assoc($result);
    
    if(mysqli_num_rows($result) > 0){
        if($password == $row["password"]){
            $_SESSION["Signin"] = true;
            header("Location: search_train.php");
            exit();
        }
        else{
            
            header("Location: display_wrong_credentials.php");
        }
    }
    else{
        header("Location: display_wrong_credentials.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
</head>
<body>
    <header>
        .<div class="title">
            <h1>Indian Railways</h1> 
        </div>
        <hr>
        <div class="login-heading">
            <h2>Login Here!</h2>
        </div>
    </header>
    <div class="container">
        <form action="" method="POST" class="form">
            <label for="username">Username*</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <div class="submit">
                <input type="submit" name="submit" class="bot" value="Sign in">
                <a id="botkebot" href="register.php">Register</a>
            </div>
        </form>
        <?php if(isset($error)) echo "<p>$error</p>"; ?>
    </div>
</body>
</html>

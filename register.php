<?php
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $Username=$_POST['username'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    //database connection
    $conn=new mysqli('localhost','root','','user_details');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt=$conn->prepare("insert into registration(firstname,lastname,username,age,gender,email,phone")
    }
?>
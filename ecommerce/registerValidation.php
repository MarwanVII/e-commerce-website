<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate name
    if (empty($_POST["fullName"]))
    {
        $_SESSION['fullNameError'] = "Please enter your name.";
    }
    else
    {
        // Check if the name format is valid
        if (!preg_match('/^([a-zA-Z]{3,})(\s([a-zA-Z]{3,}))+$/',$_POST["fullName"]))
        {
            $_SESSION['fullNameError'] = "Invalid Name Format.";
        }
        else
        {
            $_POST["fullName"]=validate($_POST["fullName"]);
        }
    }

    // Validate email
    if (empty($_POST["email"]))
    {
        $_SESSION['emailError'] = "Please enter your email.";
    }
    else
    {
        // Check if the email format is valid
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['emailError'] = "Invalid Email Format.";
        }
        else
        {
            $_POST["email"]=validate($_POST["email"]);
        }
    }

    // Validate password
    if (empty($_POST["password"]))
    {
        $_SESSION['passwordError'] = "Please enter a password.";
    }
    else
    {
        // Check if the password format is valid
        if(!preg_match('/^[A-Za-z0-9]{8,}$/',$_POST["password"]))
        {
            $_SESSION['passwordError'] = "Invalid Password Format.";
        }
        else
        {
            $_POST["password"]=validate($_POST["password"]);
        }
    }

    // Validate City
    if (empty($_POST["city"])) {
        $_SESSION['cityError'] = "Please enter your city.";
    } else {
        // Check if the city format is valid
        if (!preg_match("/^[a-zA-Z0-9' ]*$/",$_POST["city"])) {
            $_SESSION['cityError'] = "Invalid City Format.";
        }
        else
        {
            $_POST["city"]=validate($_POST["city"]);
        }
    }

    // Validate st
    if (empty($_POST["street"])) {
        $_SESSION['streetError'] = "Please enter your street.";
    }
    else {
        // Check if the street format is valid
        if (!preg_match("/^[a-zA-Z0-9 ]*$/",$_POST["street"])) {
            $_SESSION['streetError'] = "Invalid street Format.";
        }
        else
        {
            $_POST["street"]=validate($_POST["street"]);
        }
    }

    // Validate phone
    if (empty($_POST["tel"])) {
        $_SESSION['telError'] = "Please enter your phone number.";
    } else {
        // Check if the street format is valid
        if (!preg_match("/^01[0125][0-9]{8}$/",$_POST["tel"])) {
            $_SESSION['telError'] = "Invalid Phone Number Format.";
        }
        else
        {
            $_POST["tel"]=validate($_POST["tel"]);
        }
    }

    // If there are no validation errors, proceed to registration
    if (empty($_SESSION['fullNameError']) && empty($_SESSION['emailError']) && empty($_SESSION['passwordError']) && empty($_SESSION['cityError']) && empty($_SESSION['streetError']) && empty($_SESSION['telError'])) {
        // TODO: Connect to the database and insert the user's data (name, email, password, city, street, phone).
        include 'connectDatabase.php';

        // User input
        $fullName = $_POST["fullName"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password for security
        $city = $_POST["city"];
        $st = $_POST["street"];
        $phone = $_POST["tel"];


        // Prepare the SQL statement
        $registerUser = $pdo->prepare("INSERT INTO user (fullName, email, password, city, st, phone) VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameters to the statement
        $registerUser->bindParam(1, $fullName);
        $registerUser->bindParam(2, $email);
        $registerUser->bindParam(3, $password);
        $registerUser->bindParam(4, $city);
        $registerUser->bindParam(5, $st);
        $registerUser->bindParam(6, $phone);

        // Execute the statement
        $registerUser->execute();

        // Redirect the user to a thank-you page or login page after successful registration.
        header("location: login.php");
        exit();
    }
    else
    {
        header("location: register.php");
    }
}
else{
    echo '<h1>'."Wrong request method!".'</h1>';
    header('Refresh: 3;URL=register.php');
}
function validate($input){
    $input=trim($input);
    $input=strip_tags($input);
    $input=htmlspecialchars($input);
    return $input;
}
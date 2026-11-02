<?php

session_start();
require_once "config.php";
// require once imports the config file only if the file hasnt already been run

if (isset($_POST["register"])) {
    $rawName = $_POST["name"];
    $name = mb_convert_case($rawName, MB_CASE_TITLE, "UTF-8");

    $email  = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    // variable setting with the password being hashed for security 

    // Unicode pattern allowing letters in any language, spaces, hyphens, and apostrophes (2 to 50 characters)
    if (!preg_match("/^[\p{L}\s'-]{2,50}$/u", $name)) {
        $_SESSION["register_error"] = "Invalid name. Use 2-50 characters (letters, spaces, hyphens, apostrophes only).";
        $_SESSION["active_form"] = "register";
        header("Location: login.php");
        exit();
    }


    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $checkEmail = $stmt->get_result();

    //uses an SQL query to compare the input email with the emails in the database
    if($checkEmail -> num_rows > 0) {
        // if the email entered comes up in the DB then print the error 
        $_SESSION["register_error"] = "Email is already registered!";
        $_SESSION["active_form"] = "register";
    } else {
        // turns all inputs into strings before they are entered into the DB to prevent SQL injection
        $insertStmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insertStmt->bind_param("sss", $name, $email, $password);
        $insertStmt->execute();
        
        // if the email isnt taken then add it to the DB
        unset($_SESSION['register_error']);
        unset($_SESSION['active_form']);
    }

    header("Location: login.php");
    // header redirects the page based on the file selected
    exit();
    // exit prevents the rest of the code from running after the page has been changed
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    // prepare creates a SQL request remplate that can be called using the variable
    // the ? acts as a placeholder that can be changed 
    $stmt->bind_param("s", $email);
    // bind_param binds the $email to the SQL request and the "s" makes sure its a string to
    // prevent an SQL injection 
    $stmt->execute();
    // this executes the the now formatted SQL command
    $result = $stmt->get_result();
    // retrieves the results of the command

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Prevent session fixation by generating a brand new Session ID
            session_regenerate_id(true);

            // sets the users details
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            // 2. Clear any lingering error messages or form state
            // even if the page changes the session would keep the data 
            // unsetting the active form means that the website goes back to default 
            unset($_SESSION['login_error']);
            unset($_SESSION['active_form']);

            // 3. Redirect to the protected main website and stop execution
            header("Location: index.html");
            exit();
        }
    }

    $_SESSION["login_error"] = "Incorrect email or password!";
    $_SESSION["active_form"] = "login";
    header("Location: login.php");
    exit();
}


















?>
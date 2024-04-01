<?php
    include_once("conn.php");
    session_start();
    $login_error = '';

    if(isset($_POST['submit'])) {
        $tech_username = mysqli_real_escape_string($conn, $_POST['tech_username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $select = "SELECT * FROM tech_acc WHERE tech_username = '$tech_username' AND password = '$password'";
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if($row['role'] == 'admin') {
                $_SESSION['admin_name'] = $row['tech_username'];
                header('location:admin_page.php');
            } elseif ($row['role'] == 'technician') {
                $_SESSION['tech_username'] = $row['tech_username'];
                $_SESSION['tdesignation'] = $row['tdesignation'];

                // Redirect to tech_acc.php with the technician's username
                header("location:tech_acc.php?tech_username=" . $row['tech_username']);
            } else {
                $login_error = "Invalid account!";
            }
        } else {
            $login_error = "Invalid username or password!";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<style>
        /* Style for header image */
        #header-image {
            width: 100px; /* Adjust as needed */
            height: 100px; /* Adjust as needed */
            border-radius: 50%; /* Circular shape */
            position: absolute;
            top: 40px; /* Adjust as needed */
            right: 50px; /* Adjust as needed */
        }

        /* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9; /* Light gray background */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    
}

.form-container {
    background: #fff; /* White background for the form */
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

h1 {
    color: #4CAF50; /* Green color for the main title */
    margin-bottom: 20px;
    text-align: center;
}

p {
    color: #666; /* Dark gray for text */
    text-align: center;
    margin-bottom: 30px;
}



label {
    color: #333; /* Darker gray for labels */
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd; /* Light gray border */
    border-radius: 4px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    background: #4CAF50; /* Green background for submit button */
    color: white;
    font-size: 16px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background: #45a049; /* Darker green on hover */
}

input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Add box-sizing */
        }

a {
    color: #4CAF50; /* Green color for links */
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.error-msg {
    color: red; /* Or any color you want for the text */
    text-align: center; /* Center the text */
    margin-top: -15px; /* Space above the error message */
    margin-bottom: 20px; /* Space below the error message */
    /* Add other styles as needed */
}

/* Additional styles for responsive design */
@media (max-width: 768px) {
    .form-container {
        width: 90%;
        margin: 0 auto;
    }
}

    </style>

<head>
    <!-- [Your existing head content] -->
    <title>Login Form</title>
    <!-- [Your existing CSS styles] -->
</head>
<body>
<div class="form-container">
        <form action="" method="POST">
            <h1> AgriConnect </h1>
            <p>Connecting Farmers and Buyers</p>

            <div class="error-msg"><?php echo $login_error; ?></div>

            <label>USER NAME: </label>
            <input type="text" name="tech_username" required placeholder="Enter username"><br>

            <label>PASSWORD: </label>
            <input type="password" name="password" required placeholder="Enter password"><br>

            <input type="submit" name="submit" value="Login now" class="form-btn"><br><br>
            <p> <a href="front_page.php" class="btn">Go Back To Agri Map</a></p>
        </form>
    </div>
</body>
</html>

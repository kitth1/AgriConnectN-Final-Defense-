<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faccount";

$conn = new mysqli($servername, $username, $password, $dbname);

$ID = "";
$crop_status = "";
$crop_history = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["ID"])) {
        header('location:admin_page.php');
        exit;
    }

    $ID = $_GET['ID'];
    $sql = "SELECT * FROM crop_list WHERE ID = $ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header('location:admin_page.php');
        exit;
    }
    $crop_status = $row["crop_status"];
    $crop_history = $row["crop_history"];
} else {
    $ID = $_POST["ID"];
    $crop_status = $_POST["crop_status"];
    $crop_history = $_POST["crop_history"];

    do {
        if (empty($crop_status)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Update crop status in the crop_list table
        $sql = "UPDATE crop_list SET crop_status = '$crop_status' WHERE ID = $ID";
        if (!$conn->query($sql)) {
            echo 'Invalid query: ' . $conn->error;
            break;
        }

        // Insert crop history into the crophistory table
        $sqlHistory = "INSERT INTO crophistory (ID, crop_history) VALUES ('$ID', '$crop_history')";
        if (!$conn->query($sqlHistory)) {
            echo 'Invalid query: ' . $conn->error;
            break;
        }

        header('location:admin_page.php');
        exit;
    } while (false);
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
       /* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body, html {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9;
    display: flex;
    justify-content: center;
    padding-top: 50px; /* Adjust the padding as needed */
}

.container {
    width: 100%; /* Allow the container to grow as needed */
    margin: auto;
    padding: 40px; /* Increase padding for more space inside the container */
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.form-control {
    width: 100%;
    padding: 15px; /* More padding for larger input fields */
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px; /* Larger font size for better readability */
}

.btn {
    padding: 10px 20px; /* More padding for larger buttons */
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    font-size: 16px; /* Larger font size for buttons */
    margin-right: 10px; /* Adjust spacing between buttons */
}

.btn-primary {
    background-color: #4CAF50;
    color: white;
    border: none;
}

.btn-outline-primary {
    background-color: transparent;
    color: #4CAF50;
    border: 1px solid #4CAF50;
}

.btn:hover, .btn-outline-primary:hover {
    opacity: 0.8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 95%;
        max-width: none; /* Allow the container to fill the screen */
    }
}
    </style>

</head>
<body>
    <div class="container my-5">
        <h2>Update Crop Status</h2>
        <br>
        <form method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
             
            <div class="row mb-3">
                <div class="col-sm-6">
                <select name="crop_status" class="form-control">
                <option value="seedling" <?php echo $crop_status == 'seedling' ? 'selected' : ''; ?>>Seedling</option>
                <option value="sprouting" <?php echo $crop_status == 'sprouting' ? 'selected' : ''; ?>>Sprouting</option>
                <option value="ripening" <?php echo $crop_status == 'ripening' ? 'selected' : ''; ?>>Ripening</option>
                <option value="harvesting" <?php echo $crop_status == 'harvesting' ? 'selected' : ''; ?>>Harvesting</option>
                <option value="withered" <?php echo $crop_status == 'withered' ? 'selected' : ''; ?>>Withered</option>

                        </select><br>
                </div> 
            </div>
         
        
            <div class="row mb-3">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-outline-primary" href="/AgriConnectN/admin_page.php">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>


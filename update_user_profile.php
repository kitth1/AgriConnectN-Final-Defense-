
<!DOCTYPE html>
<html lang="en">

<?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "faccount";
  
      $conn = new mysqli($servername, $username, $password, $dbname);

    $ID = "";
    $tname="";
    $age="";
    $sex="";
    $tcontact="";
    $tdesignation="";
    $role="";
    $tech_username="";
    $password="";
    $confirm_pass="";

    $errorMessage="";
    $successMessage="";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (!isset($_GET["ID"])) {
            header('location:user_profile.php');
            exit;
        }

        $ID = $_GET['ID'];

        $sql = "SELECT * FROM tech_acc WHERE ID = $ID";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header('location:user_profile.php');
            exit;
        }

        $tname= $row["tname"];
        $age= $row["age"];
        $sex= $row["sex"];
        $tcontact= $row["tcontact"];
        $tdesignation= $row["tdesignation"];
        $role= $row["role"];
        $tech_username= $row["tech_username"];
        $password= $row["password"];
        $confirm_pass= $row["confirm_pass"];
    }
    else {

        $ID = $_POST["ID"];
        $tname= $_POST["tname"];
        $age= $_POST["age"];
        $sex= $_POST["sex"];
        $tcontact= $_POST["tcontact"];
        $tdesignation= $_POST["tdesignation"];
        $role= $_POST["role"];
        $tech_username= $_POST["tech_username"];
        $password= $_POST["password"];
        $confirm_pass= $_POST["confirm_pass"];

        if (empty($tname) || empty($age) || empty($sex) || empty($tcontact) || empty($tdesignation) || empty($role) || empty($tech_username) || empty($password) || empty($confirm_pass)) {
            $errorMessage = "All the fields are required";
        } else {

             // Check if the username already exists and does not belong to the current user
        $checkUsernameSql = "SELECT * FROM tech_acc WHERE tech_username = ? AND ID != ?";
        $checkUsernameStmt = $conn->prepare($checkUsernameSql);
        $checkUsernameStmt->bind_param("si", $tech_username, $ID);
        $checkUsernameStmt->execute();
        $usernameResult = $checkUsernameStmt->get_result();

        if ($usernameResult->num_rows > 0) {
            // Username already exists and does not belong to the current user
            $errorMessage = "The username '$tech_username' is already taken by another user.";
        } else {
            // Check if another technician is already managing the specified barangay (for technician role)
            if ($role == 'technician') {
                $checkSql = "SELECT * FROM tech_acc WHERE tdesignation = ? AND ID != ?";
                $checkStmt = $conn->prepare($checkSql);
                $checkStmt->bind_param("si", $tdesignation, $ID);
                $checkStmt->execute();
                $result = $checkStmt->get_result();
        
                if ($result->num_rows > 0) {
                    // Another technician already managing the barangay
                    $errorMessage = "Another technician is already managing the barangay: " . $tdesignation;
                } else {
                    // Proceed with the update if no conflict
                    updateTechAccount();
                }
                $checkStmt->close();
            } else {
                // For roles other than technician, directly proceed with the update
                updateTechAccount();
            }
        }
        $checkUsernameStmt->close();
    }
        }
    
    function updateTechAccount() {
        global $conn, $ID, $tname, $age, $sex, $tcontact, $tdesignation, $role, $tech_username, $password, $confirm_pass;
        $sql = "UPDATE tech_acc SET tname = ?, age = ?, sex = ?, tcontact = ?, tdesignation = ?, role = ?, tech_username = ?, password = ?, confirm_pass = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssi", $tname, $age, $sex, $tcontact, $tdesignation, $role, $tech_username, $password, $confirm_pass, $ID);
    
        if ($stmt->execute()) {
            echo ("Updated successfully!");
            header('location:user_profile.php');
                exit;
        } else {
            echo 'Error updating account: ' . $conn->error;
        }
        $stmt->close();
    }

    $conn->close();
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Technician</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    padding: 20px;
}

.container {
    max-width: 600px;
    margin: auto;
    padding: 2rem;
    background-color: #E5FDE6;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 1rem;
}

.form-control, .form-select {
    width:100%;
    padding: 10px;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.form-btn {
    width: 100%;
    max-width: 400px;
    padding: 10px;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

.btn-submit {
    background-color: #007bff;
}

.btn-cancel {
    background-color: #6c757d;
}

.btn-submit:hover {
    background-color: #0056b3;
}

.btn-cancel:hover {
    background-color: #5a6268;
}

.row {
    display: block;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}

.col-label {
    flex: 0 0 100%;
    width: 25%;
    text-align: left;
    padding-right: 10px;
    align-self: center;
}

.col-input {
    flex: 0 0 100%;
}

@media screen and (max-width: 576px) {
    .col-label, .col-input {
        width: 100%;
        text-align: left;
    }
    .col-label {
        margin-bottom: 0.5rem;
    }
}
    .btn-submit {
        width: 30%;
        padding: 11px;
        border: none;
        border-radius: 4px;
        color: #fff;
        font-size: 16px; /* Adjust font size as needed */
        cursor: pointer;
        text-decoration: none; /* Remove underline for Cancel link */
        display: inline-block; /* Adjust display */
        text-align: center;
        transition: background-color 0.2s ease-in-out;
        }

    .btn-cancel {
        width: 30%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        color: #fff;
        font-size: 15px; /* Adjust font size as needed */
        cursor: pointer;
        text-decoration: none; /* Remove underline for Cancel link */
        display: inline-block; /* Adjust display */
        text-align: center;
        transition: background-color 0.2s ease-in-out;
        }

        .btn-submit {
            background-color: #28a745; /* Green color for Submit button */
            
        }

.btn-cancel {
            background-color: #d9534f; /* Darker shade for Cancel button */
}

    .btn-submit:hover {
    background-color: #218838; /* Darker shade for hover effect */
}

.btn-submit,
.btn-cancel {
    margin-left: 10px; /* Add space between buttons */
}

.btn-cancel:hover {
    background-color: #BE4643; /* Darker shade for hover effect */
}

        /* Additional styles for the button wrapper */
.button-wrapper {
    display: flex;
    justify-content: center; /* Align buttons to the center */
    margin-top: 20px; /* Add some space on top of the buttons */
}
    </style>
</head>
<body>
    <div class="container my-5">
        <h2>Update Technician</h2>
      <?php if (!empty($errorMessage)): ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php endif; ?>


        <form method="POST">
        <div class="row mb-3">
        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                <label class="col-sm-3 col-form-label">Technician Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="tname" required placeholder="Last, First, Initial" value="<?php echo $tname; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Age</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="age" required placeholder="ex. 20" value="<?php echo $age; ?>">
                </div> 
            </div>
            <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Sex</label>
    <div class="select-wrapper">
        <select name="sex" class="form-control" required>
            <option value="">Choose sex</option>
            <option value="male" <?php echo ($sex == 'male') ? 'selected' : ''; ?>>male</option>
            <option value="female" <?php echo ($sex == 'female') ? 'selected' : ''; ?>>female</option>
        </select><br>
    </div> 
</div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="tcontact" required placeholder=" +63" value="<?php echo $tcontact; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Barangay Designation</label>
                <div class="col-sm-6">
                <select name="tdesignation" class="form-control"  required value="<?php echo $tdesignation; ?>"><br>
                <option value="">Choose Barangay</option>
            <option value="Agusipan" <?php echo ($tdesignation == 'Agusipan') ? 'selected' : ''; ?>>Agusipan</option>
            <option value="Agutayan" <?php echo ($tdesignation == 'Agutayan') ? 'selected' : ''; ?>>Agutayan</option>
            <option value="Bagumbayan" <?php echo ($tdesignation == 'Bagumbayan') ? 'selected' : ''; ?>>Bagumbayan</option>
            <option value="Balabag" <?php echo ($tdesignation == 'Balabag') ? 'selected' : ''; ?>>Balabag</option>
            <option value="Ban-ag" <?php echo ($tdesignation == 'Ban-ag') ? 'selected' : ''; ?>>Ban-ag</option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Sex</label>
    <div class="select-wrapper">
        <select name="role" class="form-control" required>
            <option value="">Choose sex</option>
            <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>admin</option>
            <option value="technician" <?php echo ($role == 'technician') ? 'selected' : ''; ?>>technician</option>
        </select><br>
    </div> 
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">User Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="tech_username" required  value="<?php echo $tech_username; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="password" required value="<?php echo $password; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Confirm Password</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="confirm_pass" required value="<?php echo $confirm_pass; ?>">
                </div> 
            </div>
            <div class="row mb-3">
            <div class="offset-sm-3 col-sm-6 d-grid">
            <div class="button-wrapper">
    <input type="submit" name="submit" value="Submit" class="btn btn-submit">
    <a class="btn btn-cancel" href="/AgriConnectN/user_profile.php"  role="button">Cancel</a>
    </div>
            </div>
        </form>
    </div>

</body>
</html>

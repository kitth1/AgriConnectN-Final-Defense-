<?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "faccount";
 
     $conn = new mysqli($servername, $username, $password, $dbname);

    $f_lastname="";
    $f_firstname="";
    $f_middlei="";
    $age="";
    $sex="";
    $farm_n="";
    $status="";
    $f_area="";
    $barangay="";
    $contact="";
    $latitude="";
    $longitude="";
    


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Farmer information
        $f_lastname = $_POST["f_lastname"];
        $f_firstname = $_POST["f_firstname"];
        $f_middlei = $_POST["f_middlei"];
        $age = $_POST["age"];
        $sex = $_POST["sex"];
        $farm_n = $_POST["farm_n"];
        $status = $_POST["status"];
        $f_area = $_POST["f_area"];
        $barangay = $_POST["barangay"];
        $contact = $_POST["contact"];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
    
    
        // Ensure all required fields are provided
        if (empty($f_lastname) || empty($f_firstname) || empty($f_middlei) || empty($age) || empty($sex) || empty($farm_n) || empty($status) || empty($f_area) || empty($barangay) || empty($contact)) {
            echo "All fields are required";
        } else {
                // Insert into farmer_acc2
                $stmt1 = $conn->prepare("INSERT INTO farmer_acc2 (f_lastname, f_firstname, f_middlei, age, sex, farm_n, status, f_area, barangay, contact, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt1->bind_param("ssssssssssss", $f_lastname, $f_firstname, $f_middlei, $age, $sex, $farm_n, $status, $f_area, $barangay, $contact, $latitude, $longitude);
                $stmt1->execute();
                $stmt1->close();
                header('location:admin_page.php');
        }
}

            // PHP code to fetch barangay names and coordinates from brgy_location table
            $barangayData = [];
            $sql = "SELECT barangay_location, lat, lng FROM brgy_location";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                $barangayData[] = $row;
            }
            
                    // Fetch barangays from the database
$barangayQuery = "SELECT barangay_location FROM brgy_location ORDER BY barangay_location ASC";
$barangayResult = $conn->query($barangayQuery);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Farmer</title>
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

.btn {
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 16px; /* Adjust font size as needed */
    cursor: pointer;
    text-decoration: none; /* Remove underline for links */
    display: inline-flex; /* Use inline-flex to control the size */
    align-items: center; /* Vertical alignment */
    justify-content: center; /* Horizontal alignment */
    transition: background-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    width: 265px; /* Set a fixed width */
}

/* Additional hover effect for buttons */
.btn:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow on hover */
    transform: translateY(-2px); /* Slightly raise the button on hover */
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
.btn-cancel,
 {
    margin-left: 10px; /* Add space between buttons */
}

        /* Additional styles for the button wrapper */
.button-wrapper {
    display: flex;
    justify-content: flex-end; /* Align buttons to the right */
    margin-top: 20px; /* Add some space on top of the buttons */
}
    </style>
</head>
<body>
    <div class="container my-5">
        <h2>Register New Farmer</h2>


        <form method="POST">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="f_lastname" required placeholder="" value="<?php echo $f_lastname; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="f_firstname" required placeholder="" value="<?php echo $f_firstname; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Middle Initial</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="f_middlei" required placeholder="" value="<?php echo $f_middlei; ?>">
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
                <select name="sex" class="form-control" required value="<?php echo $sex; ?>"><br>
                <option value=""> choose sex </option>
                    <option value="male"> male </option>
                    <option value="female"> female </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Farm Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="farm_n" required placeholder="ex. Green Hills" value="<?php echo $farm_n; ?>">
                </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Farm Status</label>
                <div class="select-wrapper">
                <select name="status" class="form-control" required value="<?php echo $status; ?>"><br>
                <option value="">  </option>
                    <option value="active"> active </option>
                    <option value="inactive"> inactive </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Area (hectars)</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="f_area" required placeholder="ex. 500" value="<?php echo $f_area; ?>">
                </div>  
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-6">
    <select name="barangay" class="form-control" id="barangay">
        <option value="">Select Barangay</option>
        <option value="Agusipan">Agusipan</option>
        <option value="Agutayan">Agutayan</option>
        <option value="Bagumbayan">Bagumbayan</option>
        <option value="Balabag">Balabag</option>
        <option value="Balibagan Este">Balibagan Este</option>
        <option value="Balibagan Oeste">Balibagan Oeste</option>
        <option value="Ban-ag">Ban-ag</option>
        <option value="Bantay">Bantay</option>
        <option value="Barangay Zone I (Poblacion)">Barangay Zone I (Poblacion)</option>
        <option value="Barangay Zone II (Poblacion)">Barangay Zone II (Poblacion)</option>
        <option value="Barangay Zone III (Poblacion)">Barangay Zone III (Poblacion)</option>
        <option value="Barangay Zone IV (Poblacion)">Barangay Zone IV (Poblacion)</option>
        <option value="Barangay Zone V (Poblacion)">Barangay Zone V (Poblacion)</option>
        <option value="Barangay Zone VI (Poblacion)">Barangay Zone VI (Poblacion)</option>
        <option value="Barasan Este">Barasan Este</option>
        <option value="Barasan Oeste">Barasan Oeste</option>
        <option value="Binangkilan">Binangkilan</option>
        <option value="Bitaog-Taytay">Bitaog-Taytay</option>
        <option value="Bolong Este">Bolong Este</option>
        <option value="Bolong Oeste">Bolong Oeste</option>
        <option value="Buayahon">Buayahon</option>
        <option value="Buyo">Buyo</option>
        <option value="Cabugao Norte">Cabugao Norte</option>
        <option value="Cabugao Sur">Cabugao Sur</option>
        <option value="Cadagmayan Norte">Cadagmayan Norte</option>
        <option value="Cadagmayan Sur">Cadagmayan Sur</option>
        <option value="Cafe">Cafe</option>
        <option value="Calaboa Este">Calaboa Este</option>
        <option value="Calaboa Oeste">Calaboa Oeste</option>
        <option value="Camambugan">Camambugan</option>
        <option value="Canipayan">Canipayan</option>
        <option value="Conaynay">Conaynay</option>
        <option value="Daga">Daga</option>
        <option value="Dalid">Dalid</option>
        <option value="Duyanduyan">Duyanduyan</option>
        <option value="Gen. Martin T. Delgado">Gen. Martin T. Delgado</option>
        <option value="Guno">Guno</option>
        <option value="Inangayan">Inangayan</option>
        <option value="Jibao-an">Jibao-an</option>
        <option value="Lacadon">Lacadon</option>
        <option value="Lanag">Lanag</option>
        <option value="Lupa">Lupa</option>
        <option value="Magancina">Magancina</option>
        <option value="Malawog">Malawog</option>
        <option value="Mambuyo">Mambuyo</option>
        <option value="Manhayang">Manhayang</option>
        <option value="Miraga-Guibuangan">Miraga-Guibuangan</option>
        <option value="Nasugban">Nasugban</option>
        <option value="Omambog">Omambog</option>
        <option value="Pal-agon">Pal-agon</option>
        <option value="Pungsod">Pungsod</option>
        <option value="San Sebastian">San Sebastian</option>
        <option value="Sangcate">Sangcate</option>
        <option value="Tagsing">Tagsing</option>
        <option value="Talanghauan">Talanghauan</option>
        <option value="Talongadian">Talongadian</option>
        <option value="Tigtig">Tigtig</option>
        <option value="Tungay">Tungay</option>
        <option value="Tuburan">Tuburan</option>
        <option value="Tugas">Tugas</option>
    </select>
</div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="contact" required  value="<?php echo $contact; ?>">
                </div>

    </div>
    <div class="row mb-3">
    <div class="col-sm-6 offset-sm-3 d-grid gap-2 d-md-flex justify-content-md-end">
        <input type="submit" name="submit" value="Submit" class="btn btn-submit">
        <a class="btn btn-cancel" href="/AgriConnectN/admin_page.php" role="button">Return to Admin Page</a>
    </div>
</div>


<div>
<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">
    </div>
</div>
</div>
        </form>
    </div>

</body>
</html>



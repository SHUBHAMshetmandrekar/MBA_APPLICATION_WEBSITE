<?php

ob_start();
include 'database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location:login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql_personal = "SELECT * FROM register LEFT JOIN personal ON register.A_no=personal.A_no WHERE register.A_No='$user_id'";
$result_personal = $conn->query($sql_personal);

if ($result_personal  === false) {
    die("Error executing the query: " . $conn->error);
} ?>



<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css\dash.css">

</head>

<body>
    <div class="logo-container">
        <div class="logo">
            <img src="img/logo.png" class="logo" height="100px" alt="aitd-logo">
        </div>
        <div class="content">
            <p>Society of the Missionaries of St. Francis Xavier, Pilar, Goa, Agnel Region</p>
            <h1>AGNEL INSTITUTE OF TECHNOLOGY AND DESIGN </h1>
            <p>(An Engineering Institute Managed by Agnel Charities, Approved by AICTE & Affliated to Goa University)
            </p>
            <p>Accredited by National Assessment and Acreditation Council (NAAC)</p>
        </div>
    </div>
    <div class="topnav" id="myTopnav">
        <a href="#home" class="active">Home</a>
        <a href="contact.php">Contact</a>
        <!-- <a href="about.html">About</a> -->
        <a href="signout.php">Sign Out</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"> <img src="Vector.svg"></i>
        </a>
    </div>
    <div>
        <div class="topdownload">
            <p>Download the brochure here <a href="download.php"> <button class="download" type="button"><img src="img/download.svg" style="position: relative;right: 5px;text-align: center;">Download</button> </a></p>

        </div>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <tr>
                <th>Application Form</th>
                <th>Application No.</th>
                <th>Application Submitted on</th>
                <th>Payment Status</th>
                <th>Application Status</th>
            </tr>
            <?php

            // SQL query to fetch data from the database
            $sql = "SELECT * FROM register where A_no = '$user_id'";
            $result = $conn->query($sql);

            // Display data in table rows
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>MBA Application 2024</td>";
                    echo "<td>";
                    if ($row["applied"] == "OPENED") {
                        echo "24MA";
                    } else
                        echo "24MA" . $row["applied"];
                    echo "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["payment_status"] . "</td>";
                    echo "<td>";
                    if ($row["applied"] == "OPENED") {
                        echo $row["applied"];
                    } else
                        echo "SUBMITTED";
                    echo "</td>";
                    echo "</tr>";
                    $status = $row["applied"];
                }
            } else {
                echo "<tr><td colspan='5'>No data found</td></tr>";
            }

            // Close database connection
            $conn->close();
            ?>
        </table>
    </div>
    <div>
        <div>

        </div>
        <div class="title" style="position: relative;">
            <h1 id="h1">INSTRUCTIONS TO APPLICANTS</h1>
        </div>
        <div class="text" style="font-size: 1vw;">
            <p>Applicants are advised to read the following carefully before filling the Online Application.<br><br>


                1. There are two stages in the Application form.<br>

                a. STEP 1: Application for Admission<br>

                b. STEP 2: Application Payment Details.<br><br>

                2. Application fee 1500 INR.<br><br>

                3. The fee shall be paid through ONLINE MODE (Net-Banking/UPI) only.<br><br>

                <b>Account Name : Agnel Charities<br>
                    Account No : 056301000053000<br>
                    Ban : Indian Overseas Bank <br>
                    Branc : Mapusa<br>
                    IFSC : IOBA0000563</b><br><br>

                4. It is advised to make a note of the transaction details and the same has to be furnished in the
                application payment details section.<br><br>

                5. Application without the fee paid details are duly rejected.<br><br>

                6. All the fields are mandatory. Candidates should carefully fill in the details in the On-Line
                Application at the appropriate places.<br><br>

                7. Scanned copy of eligibility certificate must be in PDF format (community certificate and academic
                certificates). Size of the PDF should be 2kb to 5MB.<br><br>

                8. Upload only good quality of recent passport size photograph. Background of photograph must be white
                or light colour. Maximum photo size for JPEG can be 2MB.<br><br>

                9. Please draw a rectangular box of size 2cm x 7cm (Height x Width) on an A4white paper. Sign with black
                or dark blue ink pen within this box. Only JPEG image format will be accepted. The maximum image size
                for the signature can be 2 MB.<br><br>

                10. Before pressing the "APPLY" button, candidates are advised to verify every particular filled in the
                application. The name of the candidate or name of his /her father/husband etc. should be spelt correctly
                in the application as it appears in the certificates/marksheets. Any mismatch found may lead to
                disqualification of the candidature.<br><br>

                11. Candidates should carefully fill in the details in the On-Line Application at the appropriate places
                and click on the "APPLY" button at the end of the On-Line Application format.<br><br>

                12. Once candidate click Apply button, system will generate an application. Copy of the same will be
                communicate to the candidate through the registered email.<br><br>


                <b>An application once submitted CANNOT be changed/rectified. Application Fees payment will not be
                    refunded </b><br><br>
            </p>
        </div>
        <div>
            <?php if ($status == "OPENED")
                echo '<div class="topdownload">
                
                <a href="form.php"><button class="download" type="button">Apply Now</button></a>
            </div>';
            else

                echo '<div class="topdownload">
                
                <a href="view_form.php"><button class="download" type="button" style ="width:150px;">View Submitted Form</button></a>
            </div>';


            ?>
        </div>


    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>

</body>

</html>
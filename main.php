<?php
session_start();
require_once 'assets/students.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$student_no = $_SESSION['student_no'];
$student = $students[$student_no];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>10 BSIT Students</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding-bottom: 4rem;
        }

        .navbar {
            background-color: #2a2a2a;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-weight: bold;
            color: #00bcd4;
            text-decoration: none;
            font-size: 1.5rem;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown button {
            background-color: #e91e63;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-size: 1rem;
        }

        .dropdown button img {
            margin-right: 10px;
            border-radius: 50%;
            width: 30px;
            height: 30px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            text-align: center;
            background-color: #333;
            min-width: 140px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            z-index: 1;
            right: 0;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #575757;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .container {
            margin-top: 50px;
            padding: 0 20px;
        }

        a {
            color: white !important;
        }

        a:hover {
            color: #00bcd4 !important;
        }

        h2 {
            text-align: center;
            color: #00bcd4;
            margin-bottom: 40px;
            font-size: 28px;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            border-collapse: collapse;
            background-color: #1a1a1a;
            color: #f8f9fa;
            border-radius: 10px;
            margin-top: 20px;
            overflow: hidden;
        }

        table thead {
            background-color: #e91e63;
            color: #f8f9fa;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border: 1px solid #444;
        }

        tbody tr:hover {
            background-color: #00bcd4;
            color: #1a1a1a;
        }

        .img-circle {
            max-width: 50px;
            max-height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            margin: 10% auto;
            background-color: #2a2a2a;
            padding: 20px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 10px;

        }

        .modal-content img {
            max-width: 100%;
            border-radius: 10px;
        }

        .close {
            color: #e91e63;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #00bcd4;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="navbar-brand">10 BSIT Students</a>
        <div class="dropdown">
            <button>
                <img src="<?php echo $student['profile_pic']; ?>" alt="Profile Picture">
                <?php echo htmlspecialchars($student['name']); ?>
            </button>
            <div class="dropdown-content">
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container">
        <h2>Students List</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Student No.</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Section</th>
                    <th>Institute</th>
                    <th>Profile</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student_data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student_data['name']); ?></td>
                        <td><?php echo htmlspecialchars($student_data['age']); ?></td>
                        <td><?php echo htmlspecialchars($student_data['address']); ?></td>
                        <td><?php echo htmlspecialchars($student_data['student_no']); ?></td>
                        <td><?php echo htmlspecialchars($student_data['course']); ?></td>
                        <td><?php echo htmlspecialchars($student_data['year']); ?></td>
                        <td><?php echo htmlspecialchars($student_data['section']); ?></td>
                        <td><?php echo htmlspecialchars($student_data['institute']); ?></td>
                        <td class="sz">
                            <center>
                                <img class="img-circle" onclick='onCLick(this, <?php echo json_encode($student_data); ?>)' src="<?php echo $student_data['profile_pic']; ?>">
                            </center>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="profilePicModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="largeProfilePic" src="" alt="Profile Picture">
            <div id="studentInfo" style="color: white; margin-top: 20px;">
                <p id="studentName"></p>
                <p id="studentAge"></p>
                <p id="studentAddress"></p>
                <p id="studentStudentNo"></p>
                <p id="studentCourse"></p>
                <p id="studentYear"></p>
                <p id="studentSection"></p>
                <p id="studentInstitute"></p>
            </div>
        </div>
    </div>


    <script>
        function onCLick(imgElement, studentData) {
            var modal = document.getElementById('profilePicModal');
            var largeImage = document.getElementById('largeProfilePic');
            var studentName = document.getElementById('studentName');
            var studentAge = document.getElementById('studentAge');
            var studentAddress = document.getElementById('studentAddress');
            var studentStudentNo = document.getElementById('studentStudentNo');
            var studentCourse = document.getElementById('studentCourse');
            var studentYear = document.getElementById('studentYear');
            var studentSection = document.getElementById('studentSection');
            var studentInstitute = document.getElementById('studentInstitute');

            // Set the modal content
            largeImage.src = imgElement.src;
            studentName.textContent = "Name: " + studentData.name;
            studentAge.textContent = "Age: " + studentData.age;
            studentAddress.textContent = "Address: " + studentData.address;
            studentStudentNo.textContent = "Student No.: " + studentData.student_no;
            studentCourse.textContent = "Course: " + studentData.course;
            studentYear.textContent = "Year: " + studentData.year;
            studentSection.textContent = "Section: " + studentData.section;
            studentInstitute.textContent = "Institute: " + studentData.institute;

            modal.style.display = 'block';
        }

        function closeModal() {
            document.getElementById('profilePicModal').style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('profilePicModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>


</body>

</html>
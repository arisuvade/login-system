<?php
session_start();
require_once 'assets/students.php'; // Load student data

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_no = $_POST['student_no'];
    $password = $_POST['password'];

    if (isset($students[$student_no]) && $students[$student_no]['password'] === $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['student_no'] = $student_no;
        header('Location: main.php');
        exit;
    } else {
        $error = "Invalid Student Number or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #1a1a1a;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }

        .login-card {
            background-color: #2a2a2a;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 378px;
        }

        h4 {
            color: #00bcd4;
            font-weight: bold;
            text-align: center;
        }

        .form-control {
            background-color: #333;
            border: none;
            border-radius: 5px;
            color: white;
        }

        .form-control:focus {
            background-color: #333;
            border-color: #00bcd4;
            box-shadow: 0px 0px 5px rgba(0, 188, 212, 0.5);
            color: white;
        }

        label {
            color: #f8f9fa;
        }

        .login-btn {
            background-color: #00bcd4;
            color: black;
            border: none;
            border-radius: 5px;
        }

        .login-btn:hover {
            background-color: #0097a7;
        }

        .alert-danger {
            background-color: #e91e63;
            color: white;
            border: none;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <h4 class="mb-4">Student Login</h4>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="student_no">Student No.</label>
                    <input type="text" name="student_no" class="form-control" id="student_no" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" class="form-control" id="password" required>
                        <span class="toggle-password" onclick="togglePassword()">
                            👁️
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn login-btn w-100 mt-3">Login</button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var icon = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.textContent = "👁️";
            } else {
                passwordField.type = "password";
                icon.textContent = "👁️";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-lPyG/6vfDTxFFIYgDdV0NYoySRTQRJW9emcOG9jT5mOBj7iVtYTlCJajGtcHThf2" crossorigin="anonymous"></script>
</body>

</html>
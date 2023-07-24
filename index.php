<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <?php
    $name = $email = $password = '';
    $nameErr = $emailErr = $passwordErr = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['name'])) {
            $nameErr = 'Name is required';
        } else {
            $name = test_input($_POST['name']);
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = 'Only letters and white space allowed';
            }
        }
        if (empty($_POST['email'])) {
            $emailErr = 'Email is required';
        } else {
            $email = test_input($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = 'Invalid email format';
            }
        }
        if (empty($_POST['password'])) {
            $passwordErr = 'Password is required';
        } else {
            $password = test_input($_POST['password']);
        }
        if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
            echo "<h3>Registration Successful!</h3>";
            echo "<p>Name: $name</p>";
            echo "<p>Email: $email</p>";
        }
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <span style="color: red;"><?php echo $nameErr; ?></span>
        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <span style="color: red;"><?php echo $emailErr; ?></span>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <span style="color: red;"><?php echo $passwordErr; ?></span>
        <br><br>

        <input type="submit" name="submit" value="Register">
    </form>
</body>
</html>

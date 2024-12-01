<?php  

require_once 'dbConfig.php';
require_once 'models.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['insertUserBtn'])) {
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $hire_date = isset($_POST['hire_date']) ? $_POST['hire_date'] : '';
    $job_title = isset($_POST['job_title']) ? $_POST['job_title'] : '';
    $salary = isset($_POST['salary']) ? $_POST['salary'] : '';
    $department = isset($_POST['department']) ? $_POST['department'] : '';

    $insertUser = insertNewUser($pdo, $first_name, $last_name, $email, $phone_number, $hire_date, $job_title, $salary, $department);

    if ($insertUser) {
        $_SESSION['message'] = "Successfully inserted!";
        header("Location: ../index.php");
        exit();
    }
}

if (isset($_POST['editUserBtn'])) {
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $hire_date = isset($_POST['hire_date']) ? $_POST['hire_date'] : '';
    $job_title = isset($_POST['job_title']) ? $_POST['job_title'] : '';
    $salary = isset($_POST['salary']) ? $_POST['salary'] : '';
    $department = isset($_POST['department']) ? $_POST['department'] : '';
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    $editUser = editUser($pdo, $first_name, $last_name, $email, $phone_number, $hire_date, $job_title, $salary, $department, $id);

    if ($editUser) {
        $_SESSION['message'] = "Successfully edited!";
        header("Location: ../index.php");
        exit();
    }
}

if (isset($_POST['deleteUserBtn'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    $deleteUser = deleteUser($pdo, $id);

    if ($deleteUser) {
        $_SESSION['message'] = "Successfully deleted!";
        header("Location: ../index.php");
        exit();
    }
}

if (isset($_GET['searchBtn'])) {
    $searchInput = isset($_GET['searchInput']) ? $_GET['searchInput'] : '';

    $searchForAUser = searchForAUser($pdo, $searchInput);
    foreach ($searchForAUser as $row) {
        echo "<tr> 
                <td>{$row['id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['hire_date']}</td>
                <td>{$row['job_title']}</td>
                <td>{$row['salary']}</td>
                <td>{$row['department']}</td>
              </tr>";
    }
}

if (isset($_POST['insertNewUserBtn'])) {
    $username = trim($_POST['username']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (!empty($username) && !empty($first_name) && !empty($last_name) && 
        !empty($password) && !empty($confirm_password)) {

        if ($password == $confirm_password) {

            $insertQuery = insertNewAccountUser($pdo, $username, $first_name, $last_name, 
                password_hash($password, PASSWORD_DEFAULT));

            if ($insertQuery['status'] == '200') {
                $_SESSION['message'] = $insertQuery['message'];
                $_SESSION['status'] = $insertQuery['status'];
                header("Location: ../login.php");
            }

            else {
                $_SESSION['message'] = $insertQuery['message'];
                $_SESSION['status'] = $insertQuery['status'];
                header("Location: ../register.php");
            }

        }
        else {
            $_SESSION['message'] = "Please make sure both passwords are equal";
            $_SESSION['status'] = "400";
            header("Location: ../register.php");
        }

    }

    else {
        $_SESSION['message'] = "Please make sure there are no empty input fields";
        $_SESSION['status'] = "400";
        header("Location: ../register.php");
    }
}

if (isset($_POST['loginUserBtn'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {

        $loginQuery = checkIfUserExists($pdo, $username);

        if ($loginQuery['status'] == '200') {
            $usernameFromDB = $loginQuery['userInfoArray']['username'];
            $passwordFromDB = $loginQuery['userInfoArray']['password'];

            if (password_verify($password, $passwordFromDB)) {
                $_SESSION['username'] = $usernameFromDB;
                header("Location: ../index.php");
            }
        }

        else {
            $_SESSION['message'] = $loginQuery['message'];
            $_SESSION['status'] = $loginQuery['status'];
            header("Location: ../login.php");
        }
    }

    else {
        $_SESSION['message'] = "Please make sure no input fields are empty";
        $_SESSION['status'] = "400";
        header("Location: ../login.php");
    }
}

if (isset($_GET['logoutUserBtn'])) {
    unset($_SESSION['username']);
    header("Location: ../login.php");
}
?>

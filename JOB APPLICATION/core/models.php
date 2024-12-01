<?php  

require_once 'dbConfig.php';

function getAllUsers($pdo) {
    $sql = "SELECT * FROM search_users_data ORDER BY first_name ASC";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();
    if ($executeQuery) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

function getUserByID($pdo, $id) {
    $sql = "SELECT * FROM search_users_data WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$id]);
    if ($executeQuery) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return null;
}

function searchForAUser($pdo, $searchQuery) {
    $sql = "SELECT * FROM search_users_data WHERE 
            CONCAT(first_name, last_name, email, phone_number, hire_date, job_title, salary, department, date_added) 
            LIKE ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute(["%".$searchQuery."%"]);
    if ($executeQuery) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

function insertNewUser($pdo, $first_name, $last_name, $email, $phone_number, $hire_date, $job_title, $salary, $department) {
    $sql = "INSERT INTO search_users_data 
            (first_name, last_name, email, phone_number, hire_date, job_title, salary, department)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $email, $phone_number, $hire_date, $job_title, $salary, $department]);
    return $executeQuery;
}

function editUser($pdo, $first_name, $last_name, $email, $phone_number, $hire_date, $job_title, $salary, $department, $id) {
    $sql = "UPDATE search_users_data
            SET first_name = ?, last_name = ?, email = ?, phone_number = ?, hire_date = ?, job_title = ?, salary = ?, department = ?
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $email, $phone_number, $hire_date, $job_title, $salary, $department, $id]);
    return $executeQuery;
}

function deleteUser($pdo, $id) {
    $sql = "DELETE FROM search_users_data WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$id]);
    return $executeQuery;
}

function checkIfUserExists($pdo, $username) {
    $response = array();
    $sql = "SELECT * FROM user_accounts WHERE username = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$username])) {

        $userInfoArray = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            $response = array(
                "result"=> true,
                "status" => "200",
                "userInfoArray" => $userInfoArray
            );
        }

        else {
            $response = array(
                "result"=> false,
                "status" => "400",
                "message"=> "User doesn't exist from the database"
            );
        }
    }

    return $response;
}

function insertNewAccountUser($pdo, $username, $first_name, $last_name, $password) {
    $response = array();
    $checkIfUserExists = checkIfUserExists($pdo, $username); 

    if (!$checkIfUserExists['result']) {

        $sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
        VALUES (?,?,?,?)";

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$username, $first_name, $last_name, $password])) {
            $response = array(
                "status" => "200",
                "message" => "User successfully inserted!"
            );
        }

        else {
            $response = array(
                "status" => "400",
                "message" => "An error occurred with the query!"
            );
        }
    }

    else {
        $response = array(
            "status" => "400",
            "message" => "User already exists!"
        );
    }

    return $response;
}
?>

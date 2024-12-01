<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';
require_once 'core/handleForms.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>

    <?php if (isset($_SESSION['message'])) { ?>
        <h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: solid;">   
            <?php echo $_SESSION['message']; ?>
        </h1>
    <?php } unset($_SESSION['message']); ?>

    <!-- Greeting and Logout Section -->
    <div class="greeting" style="text-align: center;">
        <h1>Hello there! Welcome, <?php echo $_SESSION['username']; ?></h1>
        <h1><a href="core/handleForms.php?logoutUserBtn=1">Logout</a></h1>  
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
        <input type="text" name="searchInput" placeholder="Search here">
        <input type="submit" name="searchBtn">
    </form>

    <p><a href="index.php">Clear Search Query</a></p>
    <p><a href="insert.php">Insert New User</a></p>

    <table style="width:100%; margin-top: 20px;">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Hire Date</th>
            <th>Job Title</th>
            <th>Salary</th>
            <th>Department</th>
            <th>Date Added</th>
            <th>Action</th>
        </tr>

        <?php if (!isset($_GET['searchBtn'])) { ?>
            <?php $getAllUsers = getAllUsers($pdo); ?>
            <?php foreach ($getAllUsers as $row) { ?>
                <tr>
                    <td><?php echo isset($row['first_name']) ? $row['first_name'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['last_name']) ? $row['last_name'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['email']) ? $row['email'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['phone_number']) ? $row['phone_number'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['hire_date']) ? $row['hire_date'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['job_title']) ? $row['job_title'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['salary']) ? $row['salary'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['department']) ? $row['department'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['date_added']) ? $row['date_added'] : 'N/A'; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <?php $searchForAUser = searchForAUser($pdo, $_GET['searchInput']); ?>
            <?php foreach ($searchForAUser as $row) { ?>
                <tr>
                    <td><?php echo isset($row['first_name']) ? $row['first_name'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['last_name']) ? $row['last_name'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['email']) ? $row['email'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['phone_number']) ? $row['phone_number'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['hire_date']) ? $row['hire_date'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['job_title']) ? $row['job_title'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['salary']) ? $row['salary'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['department']) ? $row['department'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['date_added']) ? $row['date_added'] : 'N/A'; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>  
        
    </table>
</body>
</html>

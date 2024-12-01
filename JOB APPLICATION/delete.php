<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Are you sure you want to delete this user?</h1>
    <?php $getUserByID = getUserByID($pdo, $_GET['id']); ?>
    <div class="container" style="border-style: solid; border-color: red; background-color: #ffcbd1; height: 500px;">
        <h2>First Name: <?php echo isset($getUserByID['first_name']) ? $getUserByID['first_name'] : 'N/A'; ?></h2>
        <h2>Last Name: <?php echo isset($getUserByID['last_name']) ? $getUserByID['last_name'] : 'N/A'; ?></h2>
        <h2>Email: <?php echo isset($getUserByID['email']) ? $getUserByID['email'] : 'N/A'; ?></h2>
        <h2>Phone Number: <?php echo isset($getUserByID['phone_number']) ? $getUserByID['phone_number'] : 'N/A'; ?></h2>
        <h2>Hire Date: <?php echo isset($getUserByID['hire_date']) ? $getUserByID['hire_date'] : 'N/A'; ?></h2>
        <h2>Job Title: <?php echo isset($getUserByID['job_title']) ? $getUserByID['job_title'] : 'N/A'; ?></h2>
        <h2>Salary: <?php echo isset($getUserByID['salary']) ? $getUserByID['salary'] : 'N/A'; ?></h2>
        <h2>Department: <?php echo isset($getUserByID['department']) ? $getUserByID['department'] : 'N/A'; ?></h2>

        <div class="deleteBtn" style="float: right; margin-right: 10px;">
            <form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <input type="submit" name="deleteUserBtn" value="Delete" style="background-color: #f69697; border-style: solid;">
            </form>         
        </div>  
    </div>
</body>
</html>

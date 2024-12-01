<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php $getUserByID = getUserByID($pdo, $_GET['id']); ?>
    <h1>Edit the user!</h1>
    <form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <p>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" value="<?php echo isset($getUserByID['first_name']) ? $getUserByID['first_name'] : ''; ?>">
        </p>
        <p>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="<?php echo isset($getUserByID['last_name']) ? $getUserByID['last_name'] : ''; ?>">
        </p>
        <p>
            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo isset($getUserByID['email']) ? $getUserByID['email'] : ''; ?>">
        </p>
        <p>
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" value="<?php echo isset($getUserByID['phone_number']) ? $getUserByID['phone_number'] : ''; ?>">
        </p>
        <p>
            <label for="hire_date">Hire Date</label>
            <input type="text" name="hire_date" value="<?php echo isset($getUserByID['hire_date']) ? $getUserByID['hire_date'] : ''; ?>">
        </p>
        <p>
            <label for="job_title">Job Title</label>
            <input type="text" name="job_title" value="<?php echo isset($getUserByID['job_title']) ? $getUserByID['job_title'] : ''; ?>">
        </p>
        <p>
            <label for="salary">Salary</label>
            <input type="text" name="salary" value="<?php echo isset($getUserByID['salary']) ? $getUserByID['salary'] : ''; ?>">
        </p>
        <p>
            <label for="department">Department</label>
            <input type="text" name="department" value="<?php echo isset($getUserByID['department']) ? $getUserByID['department'] : ''; ?>">
        </p>
        <p>
            <input type="submit" value="Save" name="editUserBtn">
        </p>
    </form>
</body>
</html>

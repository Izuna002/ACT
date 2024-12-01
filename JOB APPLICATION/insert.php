<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Insert a new user!</h1>
    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="first_name">First Name</label> 
            <input type="text" id="first_name" name="first_name" required>
        </p>
        <p>
            <label for="last_name">Last Name</label> 
            <input type="text" id="last_name" name="last_name" required>
        </p>
        <p>
            <label for="email">Email</label> 
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="phone_number">Phone Number</label> 
            <input type="text" id="phone_number" name="phone_number" required>
        </p>
        <p>
            <label for="hire_date">Hire Date</label> 
            <input type="date" id="hire_date" name="hire_date" required>
        </p>
        <p>
            <label for="job_title">Job Title</label> 
            <input type="text" id="job_title" name="job_title" required>
        </p>
        <p>
            <label for="salary">Salary</label> 
            <input type="number" id="salary" name="salary" required>
        </p>
        <p>
            <label for="department">Department</label> 
            <input type="text" id="department" name="department" required>
        </p>
        <p>
            <input type="submit" name="insertUserBtn" value="Save">
        </p>
    </form>
</body>
</html>

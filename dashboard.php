<?php
session_start();
@include 'inc/config.php';
// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: loginpage.php");
    exit();
}


// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the module name from the URL (assuming the module pages have a parameter in the URL)
$module_name = basename($_SERVER['PHP_SELF']);

// Sanitize module name to prevent directory traversal attacks
$module_name = mysqli_real_escape_string($con, $module_name);

// Retrieve email from session
$email = $_SESSION['email'];

// Check if the module is linked to the user
$sql = "SELECT COUNT(*) AS count FROM user_modules INNER JOIN modules ON user_modules.module_id = modules.id INNER JOIN user_form ON user_modules.email = user_form.email WHERE user_form.email = '$email' AND modules.module_name = '$module_name'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['count'] == 0) {
    // If the module is not linked to the user, redirect to the login page
    header("Location: loginpage.php");
    exit();
}

// Fetch all users
$sql_users = "SELECT * FROM user_form";
$result_users = mysqli_query($con, $sql_users);
$users = mysqli_fetch_all($result_users, MYSQLI_ASSOC);

// Fetch all modules
$sql_modules = "SELECT * FROM modules";
$result_modules = mysqli_query($con, $sql_modules);
$modules = mysqli_fetch_all($result_modules, MYSQLI_ASSOC);

// Fetch user-module associations
$user_module_associations = array();
$sql_user_modules = "SELECT * FROM user_modules";
$result_user_modules = mysqli_query($con, $sql_user_modules);
while ($row = mysqli_fetch_assoc($result_user_modules)) {
    $user_module_associations[$row['email']][] = $row['module_id'];
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Modules Management</title>
</head>
<body>
    <h2>User and Modules Management</h2>

    <form action="update_modules.php" method="post">
        <table border="1">
            <tr>
                <th>User</th>
                <?php foreach ($modules as $module): ?>
                    <th><?php echo $module['module_name']; ?></th>
                <?php endforeach; ?>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['email']; ?></td>
                    <?php foreach ($modules as $module): ?>
                        <td>
                            <input type="checkbox" name="user_module[<?php echo $user['email']; ?>][]" value="<?php echo $module['id']; ?>" <?php if (isset($user_module_associations[$user['email']]) && in_array($module['id'], $user_module_associations[$user['email']])) echo 'checked'; ?>>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <input type="submit" value="Update Modules">
    </form>
</body>
</html>

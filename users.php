<?php

session_start();

require "db.php";

// نتأكد إن المستخدم سجل دخوله
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// نجيب جميع المستخدمين من قاعدة البيانات
$sql = "SELECT id, name, email FROM users";

$result = mysqli_query($conn, $sql);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Users</title>
</head>
<body>

    <h2>All Registered Users</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>

        <?php while ($user = mysqli_fetch_assoc($result)) { ?>

            <tr>
                <td><?php echo htmlspecialchars($user["id"]); ?></td>
                <td><?php echo htmlspecialchars($user["name"]); ?></td>
                <td><?php echo htmlspecialchars($user["email"]); ?></td>
            </tr>

        <?php } ?>

    </table>

</body>
</html>



<?php
session_start();

require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // نستقبل البيانات من الفورم
    $email = $_POST["email"];
    $password = $_POST["password"];

    // نبحث عن المستخدم باستخدام الإيميل
    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    // نربط الإيميل بمكان علامة الاستفهام
    mysqli_stmt_bind_param($stmt, "s", $email);

    // ننفذ البحث
    mysqli_stmt_execute($stmt);

    // نستقبل نتيجة البحث
    $result = mysqli_stmt_get_result($stmt);

    // نجيب بيانات المستخدم إذا كان موجودًا
    $user = mysqli_fetch_assoc($result);




if ($user) {

    // نتحقق من كلمة المرور
   if (password_verify($password, $user["password"])) {

    // نحفظ هوية المستخدم داخل الجلسة
       $_SESSION["user_id"] = $user["id"];
  
         // ننقل المستخدم إلى صفحة عرض المستخدمين
     header("Location: users.php");
       exit;

         } 
         else
          {

    echo "Wrong password!";

}

} else {

    echo "Email not found!";

}

}
?>












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h2>Login</h2>

    <form method="POST" action="">

        <label>Email:</label>
        <input type="email" name="email" required>

        <br><br>

        <label>Password:</label>
        <input type="password" name="password" required>

        <br><br>

        <button type="submit" name="login">Login</button>

    </form>

</body>
</html>

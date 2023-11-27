<?php
// 資料庫連接設定
$servername = "localhost";  // 你的MySQL伺服器位置
$username = "root";         // 你的MySQL使用者名稱
$password = "";             // 你的MySQL密碼
$dbname = "sa&d";           // 你的資料庫名稱

// 建立連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 獲取表單提交的值
$topic = mysqli_real_escape_string($conn, $_POST["topic"]);
$optionA = mysqli_real_escape_string($conn, $_POST["optionA"]);
$optionB = mysqli_real_escape_string($conn, $_POST["optionB"]);
$optionC = mysqli_real_escape_string($conn, $_POST["optionC"]);
$optionD = mysqli_real_escape_string($conn, $_POST["optionD"]);
$answer = mysqli_real_escape_string($conn, $_POST["answer"]);

// 插入資料庫
$sql = "INSERT INTO questions (Topic, A, B, C, D, Answer) VALUES ('$topic', '$optionA', '$optionB', '$optionC', '$optionD', '$answer')";

if ($conn->query($sql) === TRUE) {
    echo "新增題目成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 關閉連接
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>題目輸入</title>
</head>
<body>

<h1>題目輸入</h1>

<form action="insert_question.php" method="post">
    <label for="topic">題目：</label>
    <input type="text" name="topic" required>
    <br>

    <label for="optionA">選項 A：</label>
    <input type="text" name="optionA" required>
    <br>

    <label for="optionB">選項 B：</label>
    <input type="text" name="optionB" required>
    <br>

    <label for="optionC">選項 C：</label>
    <input type="text" name="optionC" required>
    <br>

    <label for="optionD">選項 D：</label>
    <input type="text" name="optionD" required>
    <br>

    <label for="answer">答案：</label>
    <input type="text" name="answer" required>
    <br>

    <input type="submit" value="新增題目">
</form>

</body>
</html>

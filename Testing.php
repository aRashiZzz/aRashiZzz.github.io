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

// 隨機抽取30題
$sql = "SELECT * FROM questions ORDER BY RAND() LIMIT 30";
$result = $conn->query($sql);

// 關聯數組存放題目和答案
$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

// 關閉連接
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>答題練習</title>
</head>
<body>

<h1>答題練習</h1>

<form action="check_answers.php" method="post">
    <?php foreach ($questions as $index => $question) : ?>
        <p>
            <?php echo ($index + 1) . ". " . $question["Topic"]; ?>
        </p>
        <label><input type="radio" name="q<?php echo $index; ?>" value="1"> A. <?php echo $question["A"]; ?></label><br>
        <label><input type="radio" name="q<?php echo $index; ?>" value="2"> B. <?php echo $question["B"]; ?></label><br>
        <label><input type="radio" name="q<?php echo $index; ?>" value="3"> C. <?php echo $question["C"]; ?></label><br>
        <label><input type="radio" name="q<?php echo $index; ?>" value="4"> D. <?php echo $question["D"]; ?></label><br>
    <?php endforeach; ?>

    <input type="submit" value="提交">
</form>

</body>
</html>

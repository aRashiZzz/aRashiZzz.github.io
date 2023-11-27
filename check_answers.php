<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sa&d";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$correctCount = 0;
$incorrectQuestions = array();

foreach ($_POST as $key => $value) {
    $series = substr($key, 1);  // 去掉 "q"，得到題號
    $answer = $value;  // 使用者選擇的答案

    // 從資料庫中取得正確答案和題目內容
    $sql = "SELECT Topic, Answer, A, B, C, D FROM questions WHERE Series = '$series'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $topic = $row["Topic"];
        $correctAnswer = $row["Answer"];
        $optionA = $row["A"];
        $optionB = $row["B"];
        $optionC = $row["C"];
        $optionD = $row["D"];

        // 檢查答案是否正確
        if ($answer == $correctAnswer) {
            $correctCount++;
        } else {
            // 將答錯的題目加入陣列
            $incorrectQuestions[] = array(
                'series' => $series,
                'topic' => $topic,
                'correctAnswer' => $correctAnswer,
                'optionA' => $optionA,
                'optionB' => $optionB,
                'optionC' => $optionC,
                'optionD' => $optionD,
            );
        }
    }
}

$correctRate = ($correctCount / 30) * 100;  // 假設總題數為30

echo "<h2>答對率：$correctRate%</h2>";

if (!empty($incorrectQuestions)) {
    echo "<h3>答錯的題目：</h3>";
    foreach ($incorrectQuestions as $question) {
        echo "<p>{$question['topic']} - 正確答案：{$question['correctAnswer']}，選項內容：";
        switch ($question['correctAnswer']) {
            case 1:
                echo $question['optionA'];
                break;
            case 2:
                echo $question['optionB'];
                break;
            case 3:
                echo $question['optionC'];
                break;
            case 4:
                echo $question['optionD'];
                break;
        }
        echo "</p>";
    }
}

$conn->close();
?>

<?php
include("./Connection.php");
$sql = "SELECT id, correct_answer FROM questions";
$result = $conn->query($sql);
$score = 0;
$total_questions = $result->num_rows;
$quiz_type = "php";
while ($row = $result->fetch_assoc()) {
    $question_id = $row['id'];
    $correct_answer = $row['correct_answer'];

    if (isset($_POST['answer' . $question_id])) {
        $user_answer = $_POST['answer' . $question_id];

        if ($user_answer === $correct_answer) {
            $score++;
        }
    }
    if ($score < 5) {
        $_SESSION['result_score'] = "it's bad pro try again";
    } elseif ($score == 5) {
        $_SESSION['result_score'] = "Good but you can get more and more ";
    } elseif ($score > 8) {
        $_SESSION['result_score'] = "You are a reel programmer 👾";
    }
}

$_SESSION['result'] = "$score / $total_questions";
$_SESSION['score'] = $score;

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
    $stmt = $conn->prepare("SELECT * FROM quiz_scores WHERE user_id = ? AND quiz_type = ?  ");
    $stmt->bind_param('is', $user_id, $quiz_type);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user_id = $_COOKIE['user_id'];
        $update_sql = "UPDATE quiz_scores SET score = ? , quiz_data = CURRENT_TIMESTAMP ,  WHERE user_id = ? AND quiz_type = ?";
        $stmt_update_sql = $conn->prepare($update_sql);
        $stmt_update_sql->bind_param("iis", $score, $user_id, $quiz_type);
        $stmt_update_sql->execute();
        $stmt_update_sql->close();
        $conn->close();
    } else {
        $user_id = $_COOKIE['user_id'];
        $stmt = $conn->prepare("INSERT INTO quiz_scores (user_id, score, quiz_type) VALUES (?, ?, ?)");
        $stmt->bind_param('iis', $user_id, $score, $quiz_type);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../build.css">
    <link rel="stylesheet" href="../../src/styles.css">
</head>

<body class="bg-gradient-to-br h-screen from-[#1F2937] via-gray-800 to-gray-700 text-VeryLightGray bg-no-repeat infinite-gradient">
    <nav class="bg-DarkGray shadow-2xl border-b-2 border-gray-700">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../El e2tmad/public/Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../../assets/Img/API (2).png" class=" w-20 border-r-2 pr-2" alt="School Logo">
                    <p class="text-white font-bold text-2xl">API</p>
                </div>
            </a>
        </div>
    </nav>
    <div class="Container result_container">
        <h1 class="font-bold text-4xl">
            Your Score is : <?php echo $_SESSION['result']; ?>
            <br>
            <?php echo $_SESSION['result_score'];  ?>
        </h1>
    </div>
</body>

</html>
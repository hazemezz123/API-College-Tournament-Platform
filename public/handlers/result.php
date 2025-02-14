<?php
session_start();
include("./Connection.php");
checkUserLoggedIn();
$user_id = $_COOKIE['user_id'];
$quizType = $_POST['question_Type'];
$sql = "SELECT id, correct_answer FROM questions WHERE question_Type = '$quizType'";
$result = $conn->query($sql);
$score = 0;
$total_questions = $result->num_rows;
while ($row = $result->fetch_assoc()) {
    $question_id = $row['id'];
    $correct_answer = $row['correct_answer'];
    if (isset($_POST['answer' . $question_id])) {
        $user_answer = $_POST['answer' . $question_id];
        echo "</pre>";
        if ($user_answer == $correct_answer) {
            $score++;
        }
    }
    if ($score < 5) {
        $_SESSION['result_score'] = "it's bad pro try again";
    } elseif ($score == 5) {
        $_SESSION['result_score'] = "Good but you can get more and more ";
    } elseif ($score > 8) {
        $_SESSION['result_score'] = "You are a real programmer 👾";
    }
}

$_SESSION['result'] = "$score / $total_questions";
$_SESSION['score'] = $score;
$sql_1 = "SELECT score   FROM quiz_scores WHERE user_id = $user_id ";
$result = mysqli_query($conn, $sql_1);
while ($row = $result->fetch_assoc()) {
    $last_Score =  $row['score'];
}
if (isset($_COOKIE['user_id'])) {
    $stmt = $conn->prepare("SELECT * FROM quiz_scores WHERE user_id = ? AND quiz_type = ?  ");
    $stmt->bind_param('is', $user_id, $quizType);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        if ($score > $last_Score) {
            $update_sql = "UPDATE quiz_scores SET score = ? , quiz_date = CURRENT_TIMESTAMP   WHERE user_id = ? AND quiz_type = ?";
            $stmt_update_sql = $conn->prepare($update_sql);
            $stmt_update_sql->bind_param("iis", $score, $user_id, $quizType);
            $stmt_update_sql->execute();
            $stmt_update_sql->close();
            $conn->close();
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO quiz_scores (user_id, score, quiz_type) VALUES (?, ?, ?)");
        $stmt->bind_param('iis', $user_id, $score, $quizType);
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
    <nav class="bg-slate-700 shadow-2xl border-b-2 border-gray-700">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../../assets/Img/API (2).png" class=" w-20 border-r-2 pr-2" alt="School Logo">
                    <p class="text-white font-bold text-2xl">API</p>
                </div>
            </a>
        </div>
    </nav>
    <div class="container mx-auto mt-10 p-8 bg-gray-900 text-center rounded-lg shadow-lg">
        <h1 class="font-bold text-5xl text-white mb-4">
            Your Score:
        </h1>
        <div class="text-6xl font-extrabold text-[#4CAF50] mb-6">
            <?php echo $_SESSION['result']; ?>
        </div>
        <hr class="border-gray-700 my-4">
        <h2 class="text-3xl font-semibold text-gray-300 mb-6">
            <?php echo $_SESSION['result_score']; ?>
        </h2>
        <a href="../Home.php"
            class="inline-block text-lg font-semibold px-8 py-3 mt-8 bg-[#283f63] text-white rounded-lg 
               hover:bg-[#1e3250] hover:border-gray-400 border-2 border-transparent shadow-lg 
               transition-all duration-200 ease-in-out">
            Back to Home Page
        </a>
    </div>

</body>

</html>
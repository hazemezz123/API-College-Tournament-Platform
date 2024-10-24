<?php
include("./Connection.php");
$sql = "SELECT id, correct_answer FROM questions";
$result = $conn->query($sql);
$score = 0;
$total_questions = $result->num_rows;
while ($row = $result->fetch_assoc()) {
    $question_id = $row['id'];
    $correct_answer = $row['correct_answer'];

    if (isset($_POST['answer' . $question_id])) {
        $user_answer = $_POST['answer' . $question_id];

        if ($user_answer === $correct_answer) {
            $score++;
        }
    }
}

$_SESSION['result'] = "$score / $total_questions";
$_SESSION['score'] = $score;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../build.css">
    <style>
        .result_container {
            max-width: 700px;
            margin: 15px auto;
            background-color: #1F2937;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #E5E7EB;
        }
    </style>
</head>

<body>
    <nav class="bg-DarkGray shadow-2xl border-b-2 border-gray-700">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../El e2tmad/public/Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../../assets/Img/API (2).png" class=" w-20 border-r-2 pr-2" alt="School Logo">
                    <p class="text-white font-bold ">API Collage</p>
                </div>
            </a>
        </div>
    </nav>
    <div class="Container result_container">
        <h1>
            Your Score is : <?php echo $_SESSION['result']; ?>
        </h1>
    </div>
</body>

</html>
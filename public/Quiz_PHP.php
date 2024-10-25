<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require("./handlers/Connection.php");
checkUserLoggedIn();

if (isset($_GET['question_Type'])) {
    $QuestionType = $_GET['question_Type'];
    $sql = "SELECT * FROM questions WHERE question_Type = '$QuestionType'";
    $result = $conn->query($sql);
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Form - Dark Mode</title>
    <link rel="stylesheet" href="./build.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <style>
        @keyframes gradientScroll {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 0% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        .infinite-gradient {
            background-size: 150% 150%;
            animation: gradientScroll 10s ease-in-out infinite;
        }

        .form-container {
            max-width: 700px;
            margin: 15px auto;
            background-color: #1F2937;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #E5E7EB;
        }

        .form-title {
            font-family: "Oswald", sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #F9FAFB;
        }

        .form-question {
            margin-bottom: 1rem;
        }

        .form-radio-group {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .form-radio-group input[type="radio"] {
            appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #4B5563;
            border-radius: 50%;
            margin-right: 0.5rem;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
            background-color: #111827;
        }

        .form-radio-group input[type="radio"]:checked {
            background-color: #10B981;
            border-color: #10B981;
        }

        .form-radio-group input[type="radio"]:checked~label {
            color: #D1D5DB;
        }

        .form-radio-group input[type="radio"]:checked::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background-color: white;
        }

        .form-radio-label {
            font-size: 1rem;
            color: #9CA3AF;
        }

        .form-submit {
            background-color: #3B82F6;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .form-submit:hover {
            background-color: #2563EB;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#1F2937] via-gray-800 to-gray-700 text-VeryLightGray bg-no-repeat infinite-gradient">
    <!-- Navbar -->
    <nav class="bg-DarkGray shadow-2xl border-b-2 border-gray-700">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../El e2tmad/public/Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../assets/img/API (2).png" class=" w-24 border-r-2 pr-2" alt="School Logo">
                    <p class="text-white font-bold text-2xl">API</p>
                </div>
            </a>
        </div>
    </nav>

    <!-- Quiz Form Section -->
    <section class="h-full flex justify-center items-center">
        <div class="form-container border-gray-500 border-2">
            <h1 class="form-title"><?php echo $QuestionType ?> quiz</h1>
            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <form action="./handlers/result.php" method="POST">
                        <div class="form-question">
                            <h3 class="text-gray-200 font-bold mb-5"><?php echo $row['question']; ?></h3>
                            <div class="form-radio-group">
                                <input required id="radio-<?php echo $row['id']; ?>-1" type="radio" name="answer<?php echo $row['id']; ?>" value="<?php echo htmlspecialchars($row['option1']); ?>">
                                <label for="radio-<?php echo $row['id']; ?>-1" class="form-radio-label"><?php echo htmlspecialchars($row['option1']); ?></label>
                            </div>
                            <div class="form-radio-group">
                                <input required id="radio-<?php echo $row['id']; ?>-2" type="radio" name="answer<?php echo $row['id']; ?>" value="<?php echo htmlspecialchars($row['option2']); ?>">
                                <label for="radio-<?php echo $row['id']; ?>-2" class="form-radio-label"><?php echo htmlspecialchars($row['option2']); ?></label>
                            </div>
                            <div class="form-radio-group">
                                <input required id="radio-<?php echo $row['id']; ?>-3" type="radio" name="answer<?php echo $row['id']; ?>" value="<?php echo htmlspecialchars($row['option3']); ?>">
                                <label for="radio-<?php echo $row['id']; ?>-3" class="form-radio-label"><?php echo $row['option3']; ?></label>
                            </div>
                            <div class="form-radio-group">
                                <input required id="radio-<?php echo $row['id']; ?>-4" type="radio" name="answer<?php echo $row['id']; ?>" value="<?php echo htmlspecialchars($row['option4']); ?>">
                                <label for="radio-<?php echo $row['id']; ?>-4" class="form-radio-label"><?php echo $row['option4']; ?></label>
                            </div>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="question_Type" value="<?php echo $QuestionType; ?>">
                    <input type="submit" class="form-submit" value="Submit Quiz">
                <?php } else { ?>
                    <p>No questions available.</p>
                <?php } ?>
                    </form>
        </div>
    </section>
</body>

</html>
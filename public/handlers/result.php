<?php
// Include config file which already has session_start()
require_once(__DIR__ . "/../../includes/config.php");
require_once("./Connection.php");

// Make sure the user is logged in
checkUserLoggedIn();

// Get user ID from cookie
$user_id = isset($_COOKIE['user_id']) ? (int)$_COOKIE['user_id'] : 0;

// First, check if the user exists in the database
$check_user_stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
$check_user_stmt->bind_param('i', $user_id);
$check_user_stmt->execute();
$check_user_result = $check_user_stmt->get_result();

// If user doesn't exist, redirect to login page
if ($check_user_result->num_rows === 0) {
    // Clear the cookie as it contains an invalid user ID
    setcookie('user_id', '', time() - 3600, '/');
    header("Location: " . APP_URL . "/index.php?error=invalid_user");
    exit();
}
$check_user_stmt->close();

// Process the quiz
$quizType = $_POST['question_Type'];
$sql = "SELECT id, correct_answer FROM questions WHERE question_type = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $quizType);
$stmt->execute();
$result = $stmt->get_result();
$score = 0;
$total_questions = $result->num_rows;

while ($row = $result->fetch_assoc()) {
    $question_id = $row['id'];
    $correct_answer = $row['correct_answer'];
    if (isset($_POST['answer' . $question_id])) {
        $user_answer = $_POST['answer' . $question_id];
        if ($user_answer == $correct_answer) {
            $score++;
        }
    }
}
$stmt->close();

// Set result messages
    if ($score < 5) {
    $_SESSION['result_score'] = "You're just getting started. Keep practicing to improve your programming skills!";
} elseif ($score >= 5 && $score <= 8) {
    $_SESSION['result_score'] = "Good progress! You're developing solid programming knowledge. Keep challenging yourself!";
} else {
    $_SESSION['result_score'] = "Outstanding! You've demonstrated excellent programming mastery. You're ready for more advanced challenges!";
}

$_SESSION['result'] = "$score / $total_questions";
$_SESSION['score'] = $score;

// Check if this user has a previous score for this quiz type
$check_score_stmt = $conn->prepare("SELECT score FROM quiz_scores WHERE user_id = ? AND quiz_type = ?");
$check_score_stmt->bind_param('is', $user_id, $quizType);
$check_score_stmt->execute();
$check_score_result = $check_score_stmt->get_result();

if ($check_score_result->num_rows > 0) {
    // User has a previous score, check if current score is higher
    $row = $check_score_result->fetch_assoc();
    $last_Score = $row['score'];
    
        if ($score > $last_Score) {
        // Update the score if it's higher
        $update_sql = "UPDATE quiz_scores SET score = ?, quiz_date = CURRENT_TIMESTAMP WHERE user_id = ? AND quiz_type = ?";
            $stmt_update_sql = $conn->prepare($update_sql);
            $stmt_update_sql->bind_param("iis", $score, $user_id, $quizType);
            $stmt_update_sql->execute();
            $stmt_update_sql->close();
        }
    } else {
    // User doesn't have a previous score, insert a new record
    $insert_stmt = $conn->prepare("INSERT INTO quiz_scores (user_id, score, quiz_type) VALUES (?, ?, ?)");
    $insert_stmt->bind_param('iis', $user_id, $score, $quizType);
    $insert_stmt->execute();
    $insert_stmt->close();
}

$check_score_stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="../build.css">
    <link rel="stylesheet" href="../../src/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        @keyframes gradientScroll {
            0% { background-position: 0% 0%; }
            50% { background-position: 0% 100%; }
            100% { background-position: 0% 0%; }
        }

        .infinite-gradient {
            background-size: 150% 150%;
            animation: gradientScroll 10s ease-in-out infinite;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .score-circle {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 2.5rem;
            position: relative;
            background: rgba(15, 23, 42, 0.7);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        @keyframes scoreCount {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        
        .score-number {
            animation: scoreCount 1.2s ease-out forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }
        
        .score-text {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            padding: 8px 24px;
            border-radius: 20px;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            white-space: nowrap;
        }
        
        .feedback-card {
            background: rgba(15, 23, 42, 0.8);
            border-radius: 16px;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2.5rem;
            margin-top: 2.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
            animation-delay: 0.6s;
        }
        
        .action-button {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin: 0.5rem;
        }
        
        .action-button:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.6s ease;
        }
        
        .action-button:hover:after {
            left: 100%;
        }

        .quiz-type-badge {
            display: inline-block;
            background: <?php 
                switch($quizType) {
                    case 'PHP': echo 'linear-gradient(135deg, #8993be, #4F5B93)'; break;
                    case 'JavaScript': echo 'linear-gradient(135deg, #f7df1e, #ff9800)'; break;
                    case 'HTML': echo 'linear-gradient(135deg, #e34c26, #f06529)'; break;
                    case 'CSS': echo 'linear-gradient(135deg, #264de4, #2965f1)'; break;
                    case 'Python': echo 'linear-gradient(135deg, #306998, #FFD43B)'; break;
                    case 'MySQL': echo 'linear-gradient(135deg, #00758F, #F29111)'; break;
                    default: echo 'linear-gradient(135deg, #3b82f6, #8b5cf6)';
                }
            ?>;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            margin-bottom: 1.5rem;
        }
        
        /* Score condition styling */
        <?php if ($score < 5): ?>
        .result-container {
            border-top: 4px solid #ef4444;
        }
        .score-circle {
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
        }
        <?php elseif ($score >= 5 && $score <= 8): ?>
        .result-container {
            border-top: 4px solid #f59e0b;
        }
        .score-circle {
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.3);
        }
        <?php else: ?>
        .result-container {
            border-top: 4px solid #10b981;
        }
        .score-circle {
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
        }
        <?php endif; ?>
        
        /* Additional dark mode styling and spacing improvements */
        body {
            background-color: #0f172a;
        }
        
        .result-container {
            background: rgba(15, 23, 42, 0.9);
        }
        
        .feedback-message {
            margin-bottom: 1.5rem;
            line-height: 1.7;
            letter-spacing: 0.01em;
        }
        
        .feedback-header {
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .action-buttons {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="bg-gradient-to-br min-h-screen from-slate-900 via-slate-800 to-gray-900 text-white bg-no-repeat infinite-gradient">
    <?php include_once("../layouts/new_nav.php"); ?>

    <div class="container max-w-3xl mx-auto mt-12 px-4 pb-20 animate-fadeInUp">
        <div class="result-container rounded-lg shadow-2xl overflow-hidden">
            <div class="p-10 text-center">
                <div class="quiz-type-badge">
                    <?php echo $quizType; ?> Quiz
                </div>
                
                <h1 class="text-4xl md:text-5xl font-bold mb-10 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">
                    Your Quiz Results
                </h1>
                
                <div class="score-circle">
                    <div class="score-text">Final Score</div>
                    <div class="score-number text-5xl md:text-6xl font-extrabold 
                        <?php 
                            if ($score < 5) echo 'text-red-400';
                            elseif ($score >= 5 && $score <= 8) echo 'text-yellow-400';
                            else echo 'text-green-400';
                        ?>">
                        <?php echo $score; ?><span class="text-2xl text-gray-400">/<?php echo $total_questions; ?></span>
                    </div>
                </div>
                
                <div class="feedback-card">
                    <div class="text-xl md:text-2xl font-semibold feedback-header
                        <?php 
                            if ($score < 5) echo 'text-red-400';
                            elseif ($score >= 5 && $score <= 8) echo 'text-yellow-400';
                            else echo 'text-green-400';
                        ?>">
                        <?php
                            if ($score < 5) echo '<i class="fas fa-code mr-2"></i>Beginner Level';
                            elseif ($score >= 5 && $score <= 8) echo '<i class="fas fa-laptop-code mr-2"></i>Intermediate Level';
                            else echo '<i class="fas fa-trophy mr-2"></i>Advanced Level';
                        ?>
                    </div>
                    
                    <p class="text-lg text-gray-300 feedback-message">
                        <?php echo $_SESSION['result_score']; ?>
                    </p>
                    
                    <div class="mt-4 mb-2">
                        <div class="text-sm inline-block px-4 py-2 rounded-full bg-gray-700/50">
                            <i class="fas fa-clock mr-1"></i> Quiz completed on <?php echo date('F j, Y'); ?>
                        </div>
                    </div>
                    
                    <div class="action-buttons flex justify-center gap-6 flex-wrap">
                        <a href="../Quiz_PHP.php?question_Type=<?php echo $quizType; ?>" 
                           class="action-button inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                            <i class="fas fa-redo mr-2"></i> Try Again
                        </a>
                        <a href="../Home.php" 
                           class="action-button inline-flex items-center px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                            <i class="fas fa-home mr-2"></i> Back to Home
                        </a>
                    </div>
                </div>
                
                <div class="mt-8 text-gray-400 text-sm">
                    <p>Challenge yourself with other quiz topics to expand your skills!</p>
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-700/30 text-center">
                    <div class="flex justify-center space-x-4 mt-3">
                        <a href="https://www.linkedin.com/in/hazem-ezz-424498285/" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="https://github.com/hazemezz123" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-github text-xl"></i>
            </a>
        </div>
                    <p class="mt-3 text-xs text-gray-500">
                        <?php echo date('Y'); ?> © <?php echo APP_NAME; ?>. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add animation for the score counting
        document.addEventListener('DOMContentLoaded', function() {
            const scoreElement = document.querySelector('.score-number');
            const score = <?php echo $score; ?>;
            const totalQuestions = <?php echo $total_questions; ?>;
            
            // Optional: add a counting animation
            // This is commented out because we're using CSS animation instead
            // But you could uncomment and modify if you want a counting effect
            /*
            let currentScore = 0;
            const duration = 1500;
            const interval = 50;
            const steps = duration / interval;
            const increment = score / steps;
            
            const timer = setInterval(() => {
                currentScore += increment;
                if (currentScore >= score) {
                    currentScore = score;
                    clearInterval(timer);
                }
                scoreElement.innerHTML = Math.floor(currentScore) + '<span class="text-2xl text-gray-400">/' + totalQuestions + '</span>';
            }, interval);
            */
        });
    </script>
</body>

</html>
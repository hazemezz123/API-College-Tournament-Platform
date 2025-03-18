<!DOCTYPE html>
<html lang="en">
<?php
require_once(__DIR__ . "/../includes/config.php");
require_once("./handlers/Connection.php");
checkUserLoggedIn();

// Get the quiz type from URL parameter
if (isset($_GET['question_Type'])) {
    $quizType = $_GET['question_Type'];
    
    // Make the query case-insensitive
    $sql = "SELECT * FROM questions WHERE LOWER(question_type) = LOWER(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $quizType);
    $stmt->execute();
    $result = $stmt->get_result();
    $totalQuestions = $result->num_rows;
    
    if ($totalQuestions == 0) {
        // Try alternative type names
        $alternativeTypes = [
            'php' => ['PHP', 'php', 'Php'],
            'html' => ['HTML', 'html', 'Html'],
            'css' => ['CSS', 'css', 'Css'],
            'javascript' => ['JavaScript', 'javascript', 'Javascript', 'js', 'JS'],
            'python' => ['Python', 'python']
        ];
        
        // Convert the quiz type to lowercase for comparison
        $lowerQuizType = strtolower($quizType);
        
        // Check if we have alternatives for this type
        foreach ($alternativeTypes as $baseType => $variations) {
            if (in_array($lowerQuizType, array_map('strtolower', $variations))) {
                // Try each variation
                foreach ($variations as $variation) {
                    $sql = "SELECT * FROM questions WHERE question_type = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $variation);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $totalQuestions = $result->num_rows;
                    
                    if ($totalQuestions > 0) {
                        // We found questions with this variation
                        $quizType = $variation; // Update to the correct case
                        break 2; // Break out of both loops
                    }
                }
            }
        }
    }
} else {
    // Redirect if no quiz type specified
    header("Location: " . APP_URL . "/Home.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $quizType; ?> Quiz - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="./build.css">
    <link rel="stylesheet" href="../src/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .quiz-container {
            max-width: 800px;
            margin: 2rem auto;
            background-color: #1F2937;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 
                        0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }
        
        .quiz-header {
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .quiz-progress {
            margin-bottom: 2rem;
        }
        
        .progress-bar {
            height: 0.5rem;
            background-color: #374151;
            border-radius: 9999px;
            overflow: hidden;
        }
        
        .progress-filled {
            height: 100%;
            background-color: #3B82F6;
            transition: width 0.3s ease;
        }
        
        .question-container {
            background-color: #252f3f;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .options-container {
            display: grid;
            gap: 1rem;
        }

        .option-label {
            display: flex;
            align-items: center;
            padding: 1rem;
            background-color: #1F2937;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .option-label:hover {
            background-color: #2d3748;
        }
        
        .option-input {
            appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #4B5563;
            border-radius: 50%;
            margin-right: 1rem;
            position: relative;
            transition: all 0.2s ease;
        }
        
        .option-input:checked {
            border-color: #3B82F6;
            background-color: #3B82F6;
        }
        
        .option-input:checked::after {
            content: '';
            position: absolute;
            width: 0.5rem;
            height: 0.5rem;
            background-color: white;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .submit-container {
            background-color: #252f3f;
            padding: 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        
        .quiz-submit {
            margin-top: 2rem;
            background-color: #3B82F6;
            color: white;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            width: 100%;
        }

        .quiz-submit:hover {
            background-color: #2563EB;
        }
        
        .question-count {
            font-size: 0.875rem;
            color: #9CA3AF;
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">
    <!-- Include navigation -->
    <?php include_once("./layouts/new_nav.php"); ?>
    
    <main class="flex-grow py-10">
        <div class="container mx-auto px-4">
            <div class="quiz-container">
                <div class="quiz-header">
                    <h1 class="text-3xl font-bold"><?php echo $quizType; ?> Quiz</h1>
                    <p class="mt-2 text-blue-100">Test your knowledge of <?php echo $quizType; ?> concepts and features</p>
                </div>
                
                <div class="quiz-content">
                    <?php if ($totalQuestions > 0): ?>
                        <div class="quiz-progress">
                            <div class="w-full">
                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-300 font-medium">Progress</span>
                                    <span class="question-count">Total Questions: <?php echo $totalQuestions; ?></span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-filled" style="width: 0%"></div>
        </div>
                            </div>
                        </div>
                        
                        <form id="quiz-form" action="./handlers/result.php" method="POST">
                            <?php 
                            $questionCounter = 0;
                            while ($row = $result->fetch_assoc()): 
                                $questionCounter++;
                            ?>
                                <div class="question-container mb-10" data-question="<?php echo $questionCounter; ?>" <?php echo $questionCounter > 1 ? 'style="display: none;"' : ''; ?>>
                                    <div class="mb-6">
                                        <span class="inline-block py-1 px-2.5 bg-blue-600 text-white text-xs font-medium rounded-full mb-2">
                                            Question <?php echo $questionCounter; ?> of <?php echo $totalQuestions; ?>
                                        </span>
                                        <h3 class="text-xl font-semibold text-white mb-4"><?php echo htmlspecialchars($row['question']); ?></h3>
                                    </div>
                                    
                                    <div class="options-container">
                                        <?php for ($i = 1; $i <= 4; $i++): ?>
                                            <label class="option-label block" for="radio-<?php echo $row['id']; ?>-<?php echo $i; ?>">
                                                <input 
                                                    type="radio" 
                                                    id="radio-<?php echo $row['id']; ?>-<?php echo $i; ?>" 
                                                    name="answer<?php echo $row['id']; ?>" 
                                                    value="<?php echo htmlspecialchars($row['option' . $i]); ?>" 
                                                    class="option-input" 
                                                    required
                                                >
                                                <span class="option-custom-radio"></span>
                                                <span class="option-text"><?php echo htmlspecialchars($row['option' . $i]); ?></span>
                                            </label>
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <div class="flex justify-between mt-6">
                                        <?php if ($questionCounter > 1): ?>
                                            <button type="button" class="prev-question bg-gray-700 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition-all">
                                                Previous
                                            </button>
                                        <?php else: ?>
                                            <div></div>
                                        <?php endif; ?>
                                        
                                        <?php if ($questionCounter < $totalQuestions): ?>
                                            <button type="button" class="next-question bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all">
                                                Next
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="show-submit bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all">
                                                Finish Quiz
                                            </button>
                                        <?php endif; ?>
                            </div>
                            </div>
                            <?php endwhile; ?>
                            
                            <div class="submit-container" <?php echo $totalQuestions <= 1 ? '' : 'style="display: none;"' ?>>
                                <h3 class="text-xl font-semibold text-white mb-4">Ready to submit your answers?</h3>
                                <p class="text-gray-300 mb-6">You've answered all questions. Review your answers if needed or submit to see your results.</p>
                                
                                <input type="hidden" name="question_Type" value="<?php echo $quizType; ?>">
                                <button type="submit" class="quiz-submit test-submit bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-md transition-all text-lg w-full md:w-auto">
                                    Submit Quiz
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="text-center py-10">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mt-4 text-xl font-medium text-white">No questions available</h3>
                            <p class="mt-2 text-gray-400">Sorry, there are no questions available for this quiz type.</p>
                            <a href="Home.php" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all">
                                Return to Home
                            </a>
                        </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Include footer -->
    <?php include_once("./layouts/footer.php"); ?>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('quiz-form');
            const questionContainers = document.querySelectorAll('.question-container');
            const submitContainer = document.querySelector('.submit-container');
            const progressBar = document.querySelector('.progress-filled');
            const totalQuestions = <?php echo $totalQuestions; ?>;
            let currentQuestion = 1;
            
            // Update progress bar
            function updateProgress() {
                const progress = (currentQuestion / totalQuestions) * 100;
                progressBar.style.width = `${progress}%`;
            }
            
            // Initialize progress
            updateProgress();
            
            // Next question buttons
            document.querySelectorAll('.next-question').forEach(button => {
                button.addEventListener('click', function() {
                    const container = this.closest('.question-container');
                    const questionNum = parseInt(container.dataset.question);
                    const nextQuestionNum = questionNum + 1;
                    
                    // Check if current question is answered
                    const radios = container.querySelectorAll('input[type="radio"]');
                    let answered = false;
                    radios.forEach(radio => {
                        if (radio.checked) answered = true;
                    });
                    
                    if (!answered) {
                        alert('Please select an answer before proceeding.');
                        return;
                    }
                    
                    // Hide current question
                    container.style.display = 'none';
                    
                    // Show next question or submit container
                    if (nextQuestionNum <= totalQuestions) {
                        document.querySelector(`.question-container[data-question="${nextQuestionNum}"]`).style.display = 'block';
                        currentQuestion = nextQuestionNum;
                    } else {
                        submitContainer.style.display = 'block';
                        currentQuestion = totalQuestions;
                    }
                    
                    updateProgress();
                });
            });
            
            // Show submit button
            document.querySelectorAll('.show-submit').forEach(button => {
                button.addEventListener('click', function() {
                    const container = this.closest('.question-container');
                    
                    // Check if current question is answered
                    const radios = container.querySelectorAll('input[type="radio"]');
                    let answered = false;
                    radios.forEach(radio => {
                        if (radio.checked) answered = true;
                    });
                    
                    if (!answered) {
                        alert('Please select an answer before proceeding.');
                        return;
                    }
                    
                    // Hide current question
                    container.style.display = 'none';
                    
                    // Show submit container
                    submitContainer.style.display = 'block';
                    updateProgress();
                });
            });
            
            // Previous question buttons
            document.querySelectorAll('.prev-question').forEach(button => {
                button.addEventListener('click', function() {
                    const container = this.closest('.question-container');
                    const questionNum = parseInt(container.dataset.question);
                    const prevQuestionNum = questionNum - 1;
                    
                    // Hide current question
                    container.style.display = 'none';
                    
                    // Show previous question
                    if (prevQuestionNum >= 1) {
                        document.querySelector(`.question-container[data-question="${prevQuestionNum}"]`).style.display = 'block';
                        currentQuestion = prevQuestionNum;
                        updateProgress();
                    }
                });
            });
        });
    </script>
</body>
</html>
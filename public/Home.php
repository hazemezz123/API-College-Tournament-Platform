<!DOCTYPE html>
<html lang="en">
<?php
// Include config file which already has session_start()
require_once(__DIR__ . "/../includes/config.php");
require_once("./handlers/Connection.php");
checkUserLoggedIn();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="build.css">
    <link rel="stylesheet" href="../src/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* Simplified animations for better performance */
        @keyframes simpleGradient {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }
        
        /* Simplified and optimized card styles */
        .quiz-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
            border-radius: 1rem;
            background: rgba(30, 41, 59, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .quiz-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        
        .quiz-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--card-gradient);
            z-index: 1;
        }
        
        .quiz-card-img-wrapper {
            padding: 2rem 1.5rem 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        
        .quiz-card-img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            transition: transform 0.3s ease;
            z-index: 1;
        }
        
        .quiz-card:hover .quiz-card-img {
            transform: scale(1.05);
        }
        
        .quiz-divider {
            border: none;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 0;
        }
        
        .quiz-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            z-index: 1;
        }
        
        .quiz-title {
            font-weight: 800;
            color: white;
            margin-bottom: 0.75rem;
            font-size: 1.5rem;
            line-height: 1.2;
        }
        
        .quiz-info {
            flex: 1;
            margin-bottom: 1rem;
        }
        
        .quiz-details {
            background: rgba(0, 0, 0, 0.2);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin: 1rem 0;
        }
        
        .quiz-details-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .quiz-details-item:last-child {
            margin-bottom: 0;
        }
        
        .quiz-details-icon {
            color: var(--icon-color, #3b82f6);
            margin-right: 0.5rem;
            font-size: 0.875rem;
        }
        
        .quiz-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .start-quiz-btn {
            position: relative;
            overflow: hidden;
            background: var(--card-gradient);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .start-quiz-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }
        
        .points-badge {
            background: rgba(0, 0, 0, 0.3);
            padding: 0.3rem 0.75rem;
            border-radius: 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }
        
        .points-badge i {
            color: #FFD700;
            margin-right: 0.3rem;
        }
        
        /* Optimized grid with minimal animations */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 2rem;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        @media (min-width: 768px) {
            .cards-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        
        @media (min-width: 1024px) {
            .cards-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        
        /* Page background */
        .page-bg {
            background-color: #111827;
            min-height: 100vh;
        }
        
        /* Welcome banner */
        .welcome-banner {
            padding: 2rem 1rem;
            margin-bottom: 2rem;
        }
        
        .welcome-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            text-align: center;
            color: white;
            margin-bottom: 1rem;
            padding: 0 1rem;
        }
        
        @media (min-width: 768px) {
            .welcome-title {
                font-size: 3.5rem;
            }
        }
        
        .subtitle {
            text-align: center;
            color: #9ca3af;
            max-width: 768px;
            margin: 0 auto 2rem;
        }
        
        /* Card themes */
        .php-card {
            --card-gradient: linear-gradient(90deg, #8993be, #4F5B93);
            --icon-color: #8993be;
        }
        
        .html-card {
            --card-gradient: linear-gradient(90deg, #e34c26, #f06529);
            --icon-color: #e34c26;
        }
        
        .mysql-card {
            --card-gradient: linear-gradient(90deg, #00758F, #F29111);
            --icon-color: #00758F;
        }
        
        .react-card {
            --card-gradient: linear-gradient(90deg, #61dafb, #282c34);
            --icon-color: #61dafb;
        }
        
        .css-card {
            --card-gradient: linear-gradient(90deg, #264de4, #2965f1);
            --icon-color: #264de4;
        }
        
        .python-card {
            --card-gradient: linear-gradient(90deg, #306998, #FFD43B);
            --icon-color: #306998;
        }
        
        .ruby-card {
            --card-gradient: linear-gradient(90deg, #CC342D, #9B111E);
            --icon-color: #CC342D;
        }
        
        .rust-card {
            --card-gradient: linear-gradient(90deg, #DEA584, #000000);
            --icon-color: #DEA584;
        }
        
        .csharp-card {
            --card-gradient: linear-gradient(90deg, #9B4F96, #68217A);
            --icon-color: #9B4F96;
        }
    </style>
</head>

<body class="page-bg">
    <?php include_once("layouts/new_nav.php"); ?>
    
    <div>
        <header class="welcome-banner">
            <h1 class="welcome-title">Welcome to the Student Tournament</h1>
            <p class="subtitle text-lg">Test your programming knowledge with our interactive quizzes and compete with fellow students. Challenge yourself across multiple programming languages and technologies!</p>
        </header>
        
        <section class="cards-grid mb-20">
            <!-- PHP Quiz -->
            <div class="php-card">
                <div class="quiz-card">
                    <div class="quiz-card-img-wrapper">
                        <img class="quiz-card-img" src="assets/Img/php.png" alt="PHP Quiz">
                    </div>
                    <hr class="quiz-divider">
                    <div class="quiz-content">
                        <h3 class="quiz-title">PHP Quiz</h3>
                        <div class="quiz-info">
                            <p class="text-sm text-gray-300">Test your fundamental knowledge of PHP programming. This quiz covers basic syntax, functions, and more.</p>
                            
                            <div class="quiz-details">
                                <div class="quiz-details-item">
                                    <i class="fas fa-question-circle quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Questions:</span> 10</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-clock quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Time:</span> 10-15 minutes</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-signal quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Level:</span> Beginner</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="quiz-actions">
                            <a href="<?php echo APP_URL; ?>/Quiz_PHP.php?question_Type=PHP" class="start-quiz-btn">
                                <i class="fas fa-play-circle mr-2"></i> Start Quiz
                            </a>
                            <div class="points-badge">
                                <i class="fas fa-star"></i> 10 Points
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- HTML Quiz -->
            <div class="html-card">
                <div class="quiz-card">
                    <div class="quiz-card-img-wrapper">
                        <img class="quiz-card-img" src="assets/Img/html.png" alt="HTML Quiz">
                    </div>
                    <hr class="quiz-divider">
                    <div class="quiz-content">
                        <h3 class="quiz-title">HTML Quiz</h3>
                        <div class="quiz-info">
                            <p class="text-sm text-gray-300">Test your knowledge of HTML basics, including structure, elements, and attributes. Perfect for beginners!</p>
                            
                            <div class="quiz-details">
                                <div class="quiz-details-item">
                                    <i class="fas fa-question-circle quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Questions:</span> 10</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-clock quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Time:</span> 10-15 minutes</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-signal quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Level:</span> Beginner</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="quiz-actions">
                            <a href="<?php echo APP_URL; ?>/Quiz_PHP.php?question_Type=HTML" class="start-quiz-btn">
                                <i class="fas fa-play-circle mr-2"></i> Start Quiz
                            </a>
                            <div class="points-badge">
                                <i class="fas fa-star"></i> 10 Points
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- MySQL Quiz -->
            <div class="mysql-card">
                <div class="quiz-card">
                    <div class="quiz-card-img-wrapper">
                        <img class="quiz-card-img" src="assets/Img/language.png" alt="MySQL Quiz">
                    </div>
                    <hr class="quiz-divider">
                    <div class="quiz-content">
                        <h3 class="quiz-title">MySQL Quiz</h3>
                        <div class="quiz-info">
                            <p class="text-sm text-gray-300">Test your knowledge of MySQL fundamentals, including queries, databases, and table management.</p>
                            
                            <div class="quiz-details">
                                <div class="quiz-details-item">
                                    <i class="fas fa-question-circle quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Questions:</span> 10</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-clock quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Time:</span> 10-15 minutes</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-signal quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Level:</span> Beginner</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="quiz-actions">
                            <a href="<?php echo APP_URL; ?>/Quiz_PHP.php?question_Type=MySQL" class="start-quiz-btn">
                                <i class="fas fa-play-circle mr-2"></i> Start Quiz
                            </a>
                            <div class="points-badge">
                                <i class="fas fa-star"></i> 10 Points
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- React.js Quiz -->
            <div class="react-card">
                <div class="quiz-card">
                    <div class="quiz-card-img-wrapper">
                        <img class="quiz-card-img" src="assets/Img/structure.png" alt="React.js Quiz">
                    </div>
                    <hr class="quiz-divider">
                    <div class="quiz-content">
                        <h3 class="quiz-title">React.js Quiz</h3>
                        <div class="quiz-info">
                            <p class="text-sm text-gray-300">Test your knowledge of React.js, including components, hooks, state management, and JSX syntax.</p>
                            
                            <div class="quiz-details">
                                <div class="quiz-details-item">
                                    <i class="fas fa-question-circle quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Questions:</span> 10</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-clock quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Time:</span> 10-15 minutes</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-signal quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Level:</span> Beginner</span>
                                </div>
            </div>
        </div>
                        
                        <div class="quiz-actions">
                            <a href="<?php echo APP_URL; ?>/Quiz_PHP.php?question_Type=ReactJS" class="start-quiz-btn">
                                <i class="fas fa-play-circle mr-2"></i> Start Quiz
                            </a>
                            <div class="points-badge">
                                <i class="fas fa-star"></i> 10 Points
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CSS Quiz -->
            <div class="css-card">
                <div class="quiz-card">
                    <div class="quiz-card-img-wrapper">
                        <img class="quiz-card-img" src="assets/Img/css-3.png" alt="CSS Quiz">
                    </div>
                    <hr class="quiz-divider">
                    <div class="quiz-content">
                        <h3 class="quiz-title">CSS Quiz</h3>
                        <div class="quiz-info">
                            <p class="text-sm text-gray-300">Test your knowledge of CSS fundamentals, including selectors, properties, and layout techniques.</p>
                            
                            <div class="quiz-details">
                                <div class="quiz-details-item">
                                    <i class="fas fa-question-circle quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Questions:</span> 10</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-clock quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Time:</span> 10-15 minutes</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-signal quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Level:</span> Beginner</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="quiz-actions">
                            <a href="<?php echo APP_URL; ?>/Quiz_PHP.php?question_Type=CSS" class="start-quiz-btn">
                                <i class="fas fa-play-circle mr-2"></i> Start Quiz
                            </a>
                            <div class="points-badge">
                                <i class="fas fa-star"></i> 10 Points
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Python Quiz -->
            <div class="python-card">
                <div class="quiz-card">
                    <div class="quiz-card-img-wrapper">
                        <img class="quiz-card-img" src="assets/Img/python.png" alt="Python Quiz">
                    </div>
                    <hr class="quiz-divider">
                    <div class="quiz-content">
                        <h3 class="quiz-title">Python Quiz</h3>
                        <div class="quiz-info">
                            <p class="text-sm text-gray-300">Test your knowledge of Python basics, including syntax, data types, loops, operators, RegEx, and functions.</p>
                            
                            <div class="quiz-details">
                                <div class="quiz-details-item">
                                    <i class="fas fa-question-circle quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Questions:</span> 10</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-clock quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Time:</span> 10-15 minutes</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-signal quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Level:</span> Beginner</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="quiz-actions">
                            <a href="<?php echo APP_URL; ?>/Quiz_PHP.php?question_Type=Python" class="start-quiz-btn">
                                <i class="fas fa-play-circle mr-2"></i> Start Quiz
                            </a>
                            <div class="points-badge">
                                <i class="fas fa-star"></i> 10 Points
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ruby-card ">
                <div class="quiz-card">
                    <div class="quiz-card-img-wrapper">
                        <img class="quiz-card-img" src="assets/Img/Ruby_logo.png" alt="Ruby Quiz">
                    </div>
                    <hr class="quiz-divider">
                    <div class="quiz-content">
                        <h3 class="quiz-title">Ruby Quiz</h3>
                        <div class="quiz-info">
                            <p class="text-sm text-gray-300">Test your knowledge of Ruby programming, including syntax, blocks, gems, and object-oriented concepts.</p>
                            
                            <div class="quiz-details">
                                <div class="quiz-details-item">
                                    <i class="fas fa-question-circle quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Questions:</span> 10</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-clock quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Time:</span> 10-15 minutes</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-signal quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Level:</span> Beginner</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="quiz-actions">
                            <a href="<?php echo APP_URL; ?>/Quiz_PHP.php?question_Type=Ruby" class="start-quiz-btn">
                                <i class="fas fa-play-circle mr-2"></i> Start Quiz
                            </a>
                            <div class="points-badge">
                                <i class="fas fa-star"></i> 10 Points
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Rust Quiz -->
            <div class="rust-card">
                <div class="quiz-card">
                    <div class="quiz-card-img-wrapper">
                        <img class="quiz-card-img" src="assets/Img/Rust.png" alt="Rust Quiz">
                    </div>
                    <hr class="quiz-divider">
                    <div class="quiz-content">
                        <h3 class="quiz-title">Rust Quiz</h3>
                        <div class="quiz-info">
                            <p class="text-sm text-gray-300">Test your knowledge of Rust programming, including ownership, lifetimes, traits, and memory management.</p>
                            
                            <div class="quiz-details">
                                <div class="quiz-details-item">
                                    <i class="fas fa-question-circle quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Questions:</span> 10</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-clock quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Time:</span> 10-15 minutes</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-signal quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Level:</span> Beginner</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="quiz-actions">
                            <a href="<?php echo APP_URL; ?>/Quiz_PHP.php?question_Type=Rust" class="start-quiz-btn">
                                <i class="fas fa-play-circle mr-2"></i> Start Quiz
                            </a>
                            <div class="points-badge">
                                <i class="fas fa-star"></i> 10 Points
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- C# Quiz -->
            <div class="csharp-card">
                <div class="quiz-card">
                    <div class="quiz-card-img-wrapper">
                        <img class="quiz-card-img" src="assets/Img/C.png" alt="C# Quiz">
                    </div>
                    <hr class="quiz-divider">
                    <div class="quiz-content">
                        <h3 class="quiz-title">C# Quiz</h3>
                        <div class="quiz-info">
                            <p class="text-sm text-gray-300">Test your knowledge of C# programming, including LINQ, async/await, delegates, and .NET fundamentals.</p>
                            
                            <div class="quiz-details">
                                <div class="quiz-details-item">
                                    <i class="fas fa-question-circle quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Questions:</span> 10</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-clock quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Time:</span> 10-15 minutes</span>
                                </div>
                                <div class="quiz-details-item">
                                    <i class="fas fa-signal quiz-details-icon"></i>
                                    <span class="text-sm text-gray-300"><span class="font-medium">Level:</span> Beginner</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="quiz-actions">
                            <a href="<?php echo APP_URL; ?>/Quiz_PHP.php?question_Type=CSharp" class="start-quiz-btn">
                                <i class="fas fa-play-circle mr-2"></i> Start Quiz
                            </a>
                            <div class="points-badge">
                                <i class="fas fa-star"></i> 10 Points
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            
    </div>
    <footer class="bg-gray-900 rounded-lg m-4 shadow-lg">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="assets/Img/API (2).png" width="80" height="80" alt="Api Collage">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Api Collage</span>
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-400 sm:mb-0">
                    <li>
                        <a href="./index.php" class="hover:text-white me-4 md:me-6">Login</a>
                    </li>
                    <li>
                        <a href="./SignUp.php" class="hover:text-white me-4 md:me-6">SignUp</a>
                    </li>
                    <li>
                        <a href="./tournament_details.php" class="hover:text-white me-4 md:me-6 capitalize">Tournament Details</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-700 sm:mx-auto lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="block text-sm text-gray-400 sm:text-center">© <?php echo date('Y'); ?> <a href="#" class="hover:text-white">Api Collage</a>. All Rights Reserved.</span>
                <div class="flex mt-4 sm:mt-0 space-x-5 rtl:space-x-reverse gap-5">
                    <a href="https://www.linkedin.com/in/hazem-ezz-424498285/" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-blue-400">
                        <i class="fab fa-linkedin text-xl"></i>
                        <span class="sr-only">LinkedIn account</span>
                    </a>
                    <a href="https://github.com/hazemezz123" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github text-xl"></i>
                        <span class="sr-only">GitHub account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
<?php
require_once('../includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Details - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="build.css">
    <link rel="stylesheet" href="../src/styles.css">
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
        
        .tournament-card {
            transition: all 0.3s ease;
        }
        
        .tournament-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="bg-gray-900 max-md:h-full text-VeryLightGray bg-no-repeat infinite-gradient">
    <!-- Navbar -->
    <?php include_once("layouts/new_nav.php"); ?>

    <!-- Header Section -->
    <header class="py-12 bg-gradient-to-r from-blue-900 to-indigo-900">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Student Programming Tournament</h1>
            <p class="text-xl text-blue-200 max-w-3xl mx-auto">Challenge yourself, compete with peers, and demonstrate your programming excellence</p>
        </div>
    </header>

    <!-- Tournament Information Section -->
    <section class="container mx-auto px-4 py-12">
        <div class="bg-gray-800 shadow-lg rounded-lg p-8 max-w-4xl mx-auto border border-gray-700">
            <h2 class="text-2xl font-bold text-blue-400 mb-6 pb-4 border-b border-gray-700">Tournament Information</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-blue-300 mb-4">Participants</h3>
                <p class="text-gray-300 mb-4">Students can enter the tournament either as individuals or in teams. This flexibility allows for different learning and competitive experiences.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="bg-gray-700 p-5 rounded-lg border border-gray-600">
                        <h4 class="font-semibold text-blue-300 mb-2">Team Participation</h4>
                        <ul class="list-disc pl-6 text-gray-300">
                    <li>4 teams with 5 members each</li>
                            <li>Team members collaborate on solutions</li>
                            <li>Teams must designate a team captain</li>
                            <li>Each team receives a collective score</li>
                        </ul>
                    </div>
                    <div class="bg-gray-700 p-5 rounded-lg border border-gray-600">
                        <h4 class="font-semibold text-indigo-300 mb-2">Individual Participation</h4>
                        <ul class="list-disc pl-6 text-gray-300">
                            <li>Up to 20 individual competitors</li>
                            <li>Individuals compete for personal ranking</li>
                            <li>Personalized performance metrics</li>
                            <li>Individual certificates and recognition</li>
                </ul>
                    </div>
                </div>
            </div>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-blue-300 mb-4">Events & Challenges</h3>
                <p class="text-gray-300 mb-4">The tournament consists of various events designed to test different aspects of programming knowledge and problem-solving ability.</p>
                
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
                        <thead class="bg-gray-900 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left border-b border-gray-700">Event Type</th>
                                <th class="py-3 px-4 text-left border-b border-gray-700">Description</th>
                                <th class="py-3 px-4 text-left border-b border-gray-700">Format</th>
                                <th class="py-3 px-4 text-left border-b border-gray-700">Points</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <tr>
                                <td class="py-3 px-4 font-medium text-blue-300">Programming Quizzes</td>
                                <td class="py-3 px-4 text-gray-300">Test knowledge of various programming languages and concepts</td>
                                <td class="py-3 px-4 text-gray-300">Multiple choice questions</td>
                                <td class="py-3 px-4 text-gray-300">10 points per quiz</td>
                            </tr>
                            <tr class="bg-gray-750">
                                <td class="py-3 px-4 font-medium text-blue-300">Code Challenges</td>
                                <td class="py-3 px-4 text-gray-300">Solve practical programming problems with code</td>
                                <td class="py-3 px-4 text-gray-300">Write functional solutions</td>
                                <td class="py-3 px-4 text-gray-300">20 points per challenge</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-4 font-medium text-blue-300">Debugging Contest</td>
                                <td class="py-3 px-4 text-gray-300">Find and fix bugs in provided code</td>
                                <td class="py-3 px-4 text-gray-300">Time-based challenge</td>
                                <td class="py-3 px-4 text-gray-300">15 points per fixed bug</td>
                            </tr>
                            <tr class="bg-gray-750">
                                <td class="py-3 px-4 font-medium text-blue-300">Project Presentation</td>
                                <td class="py-3 px-4 text-gray-300">Present a small project created during the tournament</td>
                                <td class="py-3 px-4 text-gray-300">Live demonstration</td>
                                <td class="py-3 px-4 text-gray-300">30 points</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-4 font-medium text-blue-300">Team Hackathon</td>
                                <td class="py-3 px-4 text-gray-300">Build a solution to a given problem in limited time</td>
                                <td class="py-3 px-4 text-gray-300">24-hour development sprint</td>
                                <td class="py-3 px-4 text-gray-300">50 points</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold text-blue-300 mb-4">Scoring System</h3>
                <p class="text-gray-300 mb-4">Points are awarded based on performance in each event. The final ranking is determined by the total score accumulated throughout the tournament.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div class="bg-gray-750 p-4 rounded-lg border border-gray-600">
                        <h4 class="font-semibold text-green-400 mb-2">Basic Points</h4>
                        <p class="text-gray-300">Earned through completing challenges and quizzes correctly</p>
                    </div>
                    <div class="bg-gray-750 p-4 rounded-lg border border-gray-600">
                        <h4 class="font-semibold text-yellow-400 mb-2">Bonus Points</h4>
                        <p class="text-gray-300">Awarded for exceptional solutions, innovation, or time efficiency</p>
                    </div>
                    <div class="bg-gray-750 p-4 rounded-lg border border-gray-600">
                        <h4 class="font-semibold text-purple-400 mb-2">Participation Points</h4>
                        <p class="text-gray-300">Given for participating in all events, encouraging full engagement</p>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold text-blue-300 mb-4">Schedule</h3>
                <div class="bg-gray-750 p-5 rounded-lg border border-gray-600">
                    <ol class="relative border-l border-gray-600">
                        <li class="mb-6 ml-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-900 rounded-full -left-3 ring-8 ring-gray-750">
                                <svg class="w-3 h-3 text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 18a8 8 0 100-16 8 8 0 000 16z"></path></svg>
                            </span>
                            <h4 class="font-semibold text-blue-300">Opening Ceremony</h4>
                            <p class="text-gray-300">Introduction to the tournament, rules explanation, and team registrations</p>
                        </li>
                        <li class="mb-6 ml-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-900 rounded-full -left-3 ring-8 ring-gray-750">
                                <svg class="w-3 h-3 text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 18a8 8 0 100-16 8 8 0 000 16z"></path></svg>
                            </span>
                            <h4 class="font-semibold text-blue-300">Programming Quizzes</h4>
                            <p class="text-gray-300">Multiple choice quizzes on PHP, HTML, CSS, JavaScript, Python, and MySQL</p>
                        </li>
                        <li class="mb-6 ml-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-900 rounded-full -left-3 ring-8 ring-gray-750">
                                <svg class="w-3 h-3 text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 18a8 8 0 100-16 8 8 0 000 16z"></path></svg>
                            </span>
                            <h4 class="font-semibold text-blue-300">Code Challenges & Debugging</h4>
                            <p class="text-gray-300">Practical programming challenges and bug fixing competitions</p>
                        </li>
                        <li class="mb-6 ml-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-900 rounded-full -left-3 ring-8 ring-gray-750">
                                <svg class="w-3 h-3 text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 18a8 8 0 100-16 8 8 0 000 16z"></path></svg>
                            </span>
                            <h4 class="font-semibold text-blue-300">Team Hackathon</h4>
                            <p class="text-gray-300">24-hour development sprint to build solutions to assigned problems</p>
                        </li>
                        <li class="ml-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-900 rounded-full -left-3 ring-8 ring-gray-750">
                                <svg class="w-3 h-3 text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 18a8 8 0 100-16 8 8 0 000 16z"></path></svg>
                            </span>
                            <h4 class="font-semibold text-blue-300">Award Ceremony</h4>
                            <p class="text-gray-300">Recognition of winners, prize distribution, and closing remarks</p>
                        </li>
                    </ol>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-blue-300 mb-4">Registration</h3>
                <p class="text-gray-300 mb-4">Registration is open to all students of API College. Sign up as an individual or form a team to participate.</p>
                
                <div class="flex flex-col sm:flex-row gap-4 mt-4">
                    <a href="<?php echo APP_URL; ?>/SignUp.php" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Register Now
                    </a>
                    <a href="<?php echo APP_URL; ?>/Home.php" class="inline-flex items-center justify-center px-6 py-3 border border-gray-600 text-base font-medium rounded-md text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Additional Resources Section -->
    <section class="container mx-auto px-4 py-8 mb-12">
        <h2 class="text-2xl font-bold text-white mb-8 text-center">Preparation Resources</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="tournament-card bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 hover:border-blue-500">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-3">Practice Quizzes</h3>
                    <p class="text-gray-300 mb-4">Take practice quizzes to prepare for the tournament. Each quiz is designed to test your knowledge in different programming languages and concepts.</p>
                    <a href="<?php echo APP_URL; ?>/Home.php" class="inline-flex items-center text-blue-400 hover:text-blue-300">
                        Try quizzes
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="tournament-card bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 hover:border-blue-500">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-3">Study Materials</h3>
                    <p class="text-gray-300 mb-4">Access study materials and resources to help you prepare for the tournament. These resources cover all topics that will be tested.</p>
                    <a href="#" class="inline-flex items-center text-blue-400 hover:text-blue-300">
                        View resources
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="tournament-card bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 hover:border-blue-500">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-3">Team Formation</h3>
                    <p class="text-gray-300 mb-4">Looking for team members or want to join a team? Connect with other students and form your team for the tournament.</p>
                    <a href="<?php echo APP_URL; ?>/Profile.php" class="inline-flex items-center text-blue-400 hover:text-blue-300">
                        Find teammates
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <?php include_once("layouts/footer.php"); ?>
</body>

</html>
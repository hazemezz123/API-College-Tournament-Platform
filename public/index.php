<!DOCTYPE html>
<html lang="en">
<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(__DIR__ . "/handlers/Connection.php");

// Redirect to home if already logged in
if (isset($_COOKIE['user_id'])) {
    header("Location: " . APP_URL . "/Home.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Login</title>
    <link rel="stylesheet" href="build.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .bg-gradient-animation {
            background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 25%, #1D4ED8 50%, #2563EB 75%, #3B82F6 100%);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <?php include_once("./layouts/new_nav.php"); ?>
    
    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap justify-center gap-8">
                <!-- Welcome Banner -->
                <div class="w-full text-center mb-8">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-600">Welcome to API College Student Tournament</h1>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">Test your programming skills, compete with peers, and showcase your knowledge in various technology domains.</p>
                </div>
                
                <!-- Login Form -->
                <div class="w-full md:w-2/3 lg:w-1/2 p-6 rounded-lg shadow-xl bg-gray-800 border border-gray-700 hover:border-blue-500 transition-all duration-300">
                    <h2 class="text-2xl font-bold mb-6 text-white">Login to Your Account</h2>
                    
                    <form action="./handlers/process_LogIn.php" method="POST" class="space-y-6">
            <!-- Username Input -->
                        <div>
                            <label for="username" class="block text-gray-300 text-sm font-medium mb-2">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                <input type="text" id="username" name="username" required
                                    class="pl-10 w-full py-3 px-4 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            </div>
            </div>
                        
            <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-gray-300 text-sm font-medium mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                <input type="password" id="password" name="password" required
                                    class="pl-10 w-full py-3 px-4 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            </div>
            </div>
                        
            <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-gray-300 text-sm font-medium mb-2">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                <input type="email" id="email" name="email" required
                                    class="pl-10 w-full py-3 px-4 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            </div>
                            
                <?php if (isset($_SESSION['error'])): ?>
                                <div class="mt-2 p-3 bg-red-900/50 border border-red-500 rounded-md text-red-200">
                                    <p class="flex items-center">
                                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <?php echo $_SESSION['error']; session_unset(); ?>
                                    </p>
                    </div>
                <?php endif ?>
            </div>
                        
                        <!-- Submit Button and Sign Up Link -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                                Sign In
                            </button>
                            <span class="text-gray-300">
                                Don't have an account?
                                <a href="signup.php" class="text-blue-400 hover:text-blue-300 font-medium">Create an account</a>
                </span>
            </div>
        </form>
                </div>
                
        <!-- About Section -->
                <div class="w-full md:w-2/3 lg:w-1/2 p-6 rounded-lg shadow-xl bg-gray-800 border border-gray-700 hover:border-blue-500 transition-all duration-300">
                    <h2 class="text-2xl font-bold mb-4 text-white">About the Student Tournament</h2>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        The API College Student Tournament is a platform for students to test their knowledge in various programming languages and technologies. 
                        Compete against your peers in quizzes covering PHP, JavaScript, HTML, CSS, and more.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-700/50 p-4 rounded-lg border border-gray-600">
                            <h3 class="font-semibold text-lg text-blue-400 mb-2">Test Your Knowledge</h3>
                            <p class="text-gray-300">Take quizzes in different programming languages to test your skills and learn new concepts.</p>
                        </div>
                        <div class="bg-gray-700/50 p-4 rounded-lg border border-gray-600">
                            <h3 class="font-semibold text-lg text-blue-400 mb-2">Compete with Peers</h3>
                            <p class="text-gray-300">Join tournaments and compete with other students to see who has the best programming knowledge.</p>
                        </div>
                        <div class="bg-gray-700/50 p-4 rounded-lg border border-gray-600">
                            <h3 class="font-semibold text-lg text-blue-400 mb-2">Track Progress</h3>
                            <p class="text-gray-300">Monitor your scores and progress over time to see how your skills are improving.</p>
                        </div>
                        <div class="bg-gray-700/50 p-4 rounded-lg border border-gray-600">
                            <h3 class="font-semibold text-lg text-blue-400 mb-2">Win Recognition</h3>
                            <p class="text-gray-300">Top performers receive recognition and appear on the leaderboard for others to see.</p>
            </div>
        </div>

                    <a href="tournament_details.php" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium py-3 px-6 rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                        Learn more about tournaments
                    </a>
    </div>
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    <?php include_once("./layouts/footer.php"); ?>

</body>
</html>
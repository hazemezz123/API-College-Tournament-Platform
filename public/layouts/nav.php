<?php 
$is_logged_in = isset($_COOKIE['user_id']);
$current_page = basename($_SERVER['PHP_SELF']);

function is_active($page) {
    global $current_page;
    return $current_page == $page ? 'border-b-2 border-blue-500' : '';
}
?>

<head>
    <link rel="stylesheet" href="../build.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <nav class="bg-gray-900 shadow-xl border-b border-gray-800 sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="<?php echo APP_URL; ?>/<?php echo $is_logged_in ? 'Home.php' : 'index.php'; ?>" class="flex items-center space-x-3">
                    <img src="<?php echo APP_URL; ?>/assets/Img/API (2).png" class="w-16 md:w-20" alt="API College Logo">
                    <span class="text-white font-bold text-xl md:text-2xl">API College</span>
                </a>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <?php if ($is_logged_in): ?>
                        <a href="<?php echo APP_URL; ?>/Home.php" class="text-gray-300 hover:text-white px-3 py-2 font-medium text-sm md:text-base transition-all <?php echo is_active('Home.php'); ?>">
                            Home
                        </a>
                        <a href="<?php echo APP_URL; ?>/leadBored.php" class="text-gray-300 hover:text-white px-3 py-2 font-medium text-sm md:text-base transition-all <?php echo is_active('leadBored.php'); ?>">
                            Leaderboard
                        </a>
                        <a href="<?php echo APP_URL; ?>/tournament_details.php" class="text-gray-300 hover:text-white px-3 py-2 font-medium text-sm md:text-base transition-all <?php echo is_active('tournament_details.php'); ?>">
                            Tournaments
                        </a>
                        <a href="<?php echo APP_URL; ?>/Profile.php" class="text-gray-300 hover:text-white px-3 py-2 font-medium text-sm md:text-base transition-all <?php echo is_active('Profile.php'); ?>">
                            Profile
                        </a>
                        <a href="<?php echo APP_URL; ?>/handlers/Logout.php" class="ml-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-all">
                            Logout
                        </a>
                    <?php else: ?>
                        <a href="<?php echo APP_URL; ?>/index.php" class="text-gray-300 hover:text-white px-3 py-2 font-medium text-sm md:text-base transition-all <?php echo is_active('index.php'); ?>">
                            Login
                        </a>
                        <a href="<?php echo APP_URL; ?>/SignUp.php" class="text-gray-300 hover:text-white px-3 py-2 font-medium text-sm md:text-base transition-all <?php echo is_active('SignUp.php'); ?>">
                            Sign Up
                        </a>
                        <a href="<?php echo APP_URL; ?>/tournament_details.php" class="text-gray-300 hover:text-white px-3 py-2 font-medium text-sm md:text-base transition-all <?php echo is_active('tournament_details.php'); ?>">
                            Tournaments
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-3 pb-3 space-y-1">
                <?php if ($is_logged_in): ?>
                    <a href="<?php echo APP_URL; ?>/Home.php" class="block text-gray-300 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-md text-base font-medium <?php echo is_active('Home.php'); ?>">
                        Home
                    </a>
                    <a href="<?php echo APP_URL; ?>/leadBored.php" class="block text-gray-300 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-md text-base font-medium <?php echo is_active('leadBored.php'); ?>">
                        Leaderboard
                    </a>
                    <a href="<?php echo APP_URL; ?>/tournament_details.php" class="block text-gray-300 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-md text-base font-medium <?php echo is_active('tournament_details.php'); ?>">
                        Tournaments
                    </a>
                    <a href="<?php echo APP_URL; ?>/Profile.php" class="block text-gray-300 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-md text-base font-medium <?php echo is_active('Profile.php'); ?>">
                        Profile
                    </a>
                    <a href="<?php echo APP_URL; ?>/handlers/Logout.php" class="block text-white bg-red-600 hover:bg-red-700 px-3 py-2 rounded-md text-base font-medium mt-1">
                        Logout
                    </a>
                <?php else: ?>
                    <a href="<?php echo APP_URL; ?>/index.php" class="block text-gray-300 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-md text-base font-medium <?php echo is_active('index.php'); ?>">
                        Login
                    </a>
                    <a href="<?php echo APP_URL; ?>/SignUp.php" class="block text-gray-300 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-md text-base font-medium <?php echo is_active('SignUp.php'); ?>">
                        Sign Up
                    </a>
                    <a href="<?php echo APP_URL; ?>/tournament_details.php" class="block text-gray-300 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-md text-base font-medium <?php echo is_active('tournament_details.php'); ?>">
                        Tournaments
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
<?php
if (!defined('APP_URL')) {
    require_once('../../includes/config.php');
}

// Get current page for active link styling
$current_page = basename($_SERVER['PHP_SELF']);

// Check if user is logged in
$is_logged_in = isset($_COOKIE['user_id']);
?>

<nav class="bg-gray-900 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="<?php echo APP_URL; ?>/Home.php" class="flex items-center">
                        <img src="<?php echo APP_URL; ?>/assets/Img/API (2).png" class="h-10 w-10" alt="API College Logo">
                        <span class="ml-3 text-xl font-bold text-white">API College</span>
                    </a>
                </div>
            </div>
            
            <div class="flex items-center">
                <div class="hidden md:ml-6 md:flex md:space-x-8">
                    <?php if ($is_logged_in): ?>
                        <a href="<?php echo APP_URL; ?>/Home.php" 
                           class="<?php echo $current_page == 'Home.php' ? 'text-white' : 'text-gray-300 hover:text-white'; ?> px-3 py-2 text-sm font-medium">
                            Home
                        </a>
                        
                        <a href="<?php echo APP_URL; ?>/leaderboard.php" 
                           class="<?php echo $current_page == 'leaderboard.php' ? 'text-white' : 'text-gray-300 hover:text-white'; ?> px-3 py-2 text-sm font-medium">
                            Leaderboard
                        </a>
                        
                        <a href="<?php echo APP_URL; ?>/tournament_details.php" 
                           class="<?php echo $current_page == 'tournament_details.php' ? 'text-white' : 'text-gray-300 hover:text-white'; ?> px-3 py-2 text-sm font-medium">
                            Tournaments
                        </a>
                        
                        <a href="<?php echo APP_URL; ?>/Profile.php" 
                           class="<?php echo $current_page == 'Profile.php' ? 'text-white' : 'text-gray-300 hover:text-white'; ?> px-3 py-2 text-sm font-medium">
                            Profile
                        </a>
                    <?php endif; ?>
                </div>
                
                <div class="ml-4 flex items-center space-x-4">
                    <?php if ($is_logged_in): ?>
                        <a href="<?php echo APP_URL; ?>/handlers/Logout.php" 
                           class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                            Logout
                        </a>
                    <?php else: ?>
                        <a href="<?php echo APP_URL; ?>/index.php" 
                           class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Login
                        </a>
                        <a href="<?php echo APP_URL; ?>/signup.php" 
                           class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            Sign Up
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav> 
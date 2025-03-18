<!DOCTYPE html>
<html lang="en">
<?php
include("./handlers/Connection.php");
checkUserLoggedIn();
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
    $stmt = "SELECT username, email, age, id, team_type, membership_type FROM users WHERE id = '$user_id'";
    $stmt_1 = "SELECT score, quiz_type, quiz_date FROM quiz_scores WHERE user_id = '$user_id' ORDER BY quiz_date DESC";
    $stmt_2 = "SELECT sum(score) as User_Scores FROM quiz_scores WHERE user_id = '$user_id'";
    $stmt_3 = "SELECT COUNT(DISTINCT quiz_type) as completed_quizzes FROM quiz_scores WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $stmt);
    $result_1 = mysqli_query($conn, $stmt_1);
    $result_2 = mysqli_query($conn, $stmt_2);
    $result_3 = mysqli_query($conn, $stmt_3);
    $row_2 = $result_2->fetch_assoc();
    $row_3 = $result_3->fetch_assoc();
    $user_scores = $row_2['User_Scores'] ? $row_2['User_Scores'] : 0;
    $completed_quizzes = $row_3['completed_quizzes'] ? $row_3['completed_quizzes'] : 0;
} else {
    $_SESSION['MakeAccount'] = "Login First To show Your Information";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="build.css">
    <link rel="stylesheet" href="../src/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        @keyframes gradientScroll {
            0% { background-position: 0% 0%; }
            50% { background-position: 0% 100%; }
            100% { background-position: 0% 0%; }
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
        
        .profile-bg {
            background-color: #111827;
            background-image: radial-gradient(circle at top right, rgba(59, 130, 246, 0.1), transparent 40%), 
                              radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.1), transparent 40%);
            min-height: 100vh;
            background-attachment: fixed;
        }
        
        .profile-card {
            background: rgba(30, 41, 59, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            padding: 2rem;
            position: relative;
            overflow: hidden;
            height: 150px;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            object-fit: cover;
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
            top: 140px;
            z-index: 20;
            background-color: #2563eb;
        }
        
        .profile-body {
            padding: 5rem 2rem 2rem;
            text-align: center;
        }
        
        .profile-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin: 2rem 0;
        }
        
        .stat-card {
            background: rgba(15, 23, 42, 0.7);
            border-radius: 0.75rem;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            background: rgba(15, 23, 42, 0.9);
        }
        
        .stat-icon {
            font-size: 1.5rem;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-bottom: 0.75rem;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: #94a3b8;
            margin-top: 0.25rem;
        }
        
        .quiz-history {
            margin-top: 3rem;
            background: rgba(30, 41, 59, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out forwards;
            animation-delay: 0.3s;
            opacity: 0;
        }
        
        .quiz-history-header {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            padding: 1.25rem 1.5rem;
            color: white;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .quiz-history-header i {
            margin-right: 0.5rem;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            background-color: rgba(15, 23, 42, 0.7);
            color: #e2e8f0;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        
        th, td {
            padding: 1rem 1.5rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:hover td {
            background-color: rgba(15, 23, 42, 0.5);
        }
        
        .quiz-type-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .badge-php {
            background: linear-gradient(135deg, #8993be, #4F5B93);
            color: white;
        }
        
        .badge-html {
            background: linear-gradient(135deg, #e34c26, #f06529);
            color: white;
        }
        
        .badge-css {
            background: linear-gradient(135deg, #264de4, #2965f1);
            color: white;
        }
        
        .badge-javascript {
            background: linear-gradient(135deg, #f7df1e, #ff9800);
            color: black;
        }
        
        .badge-python {
            background: linear-gradient(135deg, #306998, #FFD43B);
            color: white;
        }
        
        .badge-mysql {
            background: linear-gradient(135deg, #00758F, #F29111);
            color: white;
        }
        
        .badge-reactjs {
            background: linear-gradient(135deg, #61dafb, #282c34);
            color: white;
        }
        
        .badge-ruby {
            background: linear-gradient(135deg, #CC342D, #9B111E);
            color: white;
        }
        
        .badge-rust {
            background: linear-gradient(135deg, #DEA584, #000000);
            color: white;
        }
        
        .badge-csharp {
            background: linear-gradient(135deg, #9B4F96, #68217A);
            color: white;
        }
        
        .badge-default {
            background: linear-gradient(135deg, #6b7280, #374151);
            color: white;
        }
        
        .score-value {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            font-weight: 700;
            background: rgba(15, 23, 42, 0.7);
            border: 2px solid;
        }
        
        .score-good {
            color: #10b981;
            border-color: #10b981;
        }
        
        .score-medium {
            color: #f59e0b;
            border-color: #f59e0b;
        }
        
        .score-low {
            color: #ef4444;
            border-color: #ef4444;
        }
        
        .date-value {
            color: #94a3b8;
            font-size: 0.875rem;
        }
        
        .logout-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }
        
        .logout-btn i {
            margin-right: 0.5rem;
        }
        
        .empty-state {
            padding: 3rem 2rem;
            text-align: center;
            color: #94a3b8;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: #3b82f6;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="profile-bg">
    <!-- Navbar -->
    <?php include_once("layouts/new_nav.php"); ?>
    
    <div class="container mx-auto px-4 py-12">
        <?php if (!isset($_SESSION['$MakeAccount'])): ?>
            <?php if ($row = $result->fetch_assoc()): ?>
                <div class="max-w-4xl mx-auto">
                    <div class="relative">
                        <img src="<?php echo APP_URL; ?>/assets/Img/user.png" alt="User Profile" class="profile-avatar">
                        <div class="profile-card">
                            <div class="profile-header"></div>
                            
                            <div class="profile-body">
                                <h1 class="text-3xl font-bold text-white mt-8"><?php echo $row['username'] ?></h1>
                                <p class="text-blue-300 mt-2"><?php echo $row['email'] ?></p>
                                
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                                    <div class="bg-gray-800/50 p-3 rounded-lg">
                                        <span class="text-gray-400 font-medium">Age</span>
                                        <p class="text-white"><?php echo $row['age'] ?> years</p>
                                    </div>
                                    
                                    <div class="bg-gray-800/50 p-3 rounded-lg">
                                        <span class="text-gray-400 font-medium">Member ID</span>
                                        <p class="text-white">#<?php echo $row['id'] ?></p>
                                    </div>
                                    
                                    <div class="bg-gray-800/50 p-3 rounded-lg">
                                        <span class="text-gray-400 font-medium">Member Type</span>
                                        <p class="text-white capitalize"><?php echo $row['membership_type'] ?></p>
                                    </div>
                                     <div class="bg-gray-800/50 p-3 rounded-lg">
                                        <span class="text-gray-400 font-medium">Team Type</span>
                                        <p class="text-white capitalize"><?php  if($row['team_type'] == null) { echo "No Team"; } else { echo $row['team_type']; }   ?></p>
                                    </div>
                                </div>
                                
                                <div class="profile-stats">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-trophy"></i>
                                        </div>
                                        <div class="stat-value"><?php echo $user_scores; ?></div>
                                        <div class="stat-label">Total Points</div>
                                    </div>
                                    
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="stat-value"><?php echo $completed_quizzes; ?></div>
                                        <div class="stat-label">Quiz Types</div>
                                    </div>
                                    
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="stat-value">
                                            <?php 
                                                if ($completed_quizzes > 0) {
                                                    echo round($user_scores / $completed_quizzes, 1);
                                                } else {
                                                    echo '0';
                                                }
                                            ?>
                                        </div>
                                        <div class="stat-label">Avg Score</div>
                                    </div>
                                </div>
                                
                                <a href="handlers/Logout.php" class="inline-flex items-center px-6 py-3 mt-6 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Log out
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="quiz-history">
                        <div class="quiz-history-header">
                            <i class="fas fa-history"></i> Quiz History
                        </div>
                        
                        <?php if (mysqli_num_rows($result_1) > 0): ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Quiz</th>
                                        <th>Score</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_1 = $result_1->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                                                <span class="quiz-type-badge badge-<?php echo strtolower(str_replace(' ', '', $row_1['quiz_type'])); ?>">
                                                    <?php echo $row_1['quiz_type'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="score-value <?php 
                                                    if ($row_1['score'] >= 8) echo 'score-good';
                                                    elseif ($row_1['score'] >= 5) echo 'score-medium';
                                                    else echo 'score-low';
                                                ?>">
                                                    <?php echo $row_1['score'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="date-value">
                                                    <?php echo date('M d, Y', strtotime($row_1['quiz_date'])) ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-clipboard-list"></i>
                                <p>You haven't taken any quizzes yet.</p>
                                <p class="mt-2">Head to the home page to start your first quiz!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="max-w-md mx-auto bg-gray-800 rounded-lg shadow-lg p-6 text-center text-white">
                <i class="fas fa-exclamation-circle text-4xl text-red-500 mb-4"></i>
                <h1 class="text-2xl font-bold mb-4">Login Required</h1>
                <p class="mb-6">You need to login first to view your profile information.</p>
                <a href="./index.php" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Go to Login
                </a>
            </div>
        <?php endif; ?>
    </div>
    
    <footer class="bg-gray-900 rounded-lg m-4 shadow-lg mt-12">
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
                <div class="flex mt-4 sm:mt-0 space-x-5 rtl:space-x-reverse">
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
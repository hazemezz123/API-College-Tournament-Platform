<!DOCTYPE html>
<html lang="en">
<?php
include("./handlers/Connection.php");
checkUserLoggedIn();
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
    $stmt = "SELECT username , email , age FROM users WHERE id = '$user_id' ";
    $result = mysqli_query($conn, $stmt);
    $stmt_1 = "SELECT score, quiz_type, quiz_date FROM quiz_scores WHERE user_id = '$user_id'";
    $result_1 = mysqli_query($conn, $stmt_1);
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
</head>

<body class="bg-gray-900 min-h-screen flex flex-col items-center">
    <!-- Navbar -->
    <nav class="bg-gray-900 shadow-2xl border-b border-VeryLightGray w-full">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../El e2tmad/public/Home.php">
                <div class="flex space-x-4 items-center">
                    <img src="../assets/img/API (2).png" class="w-24 border-r-2 border-white pr-2" alt="School Logo">
                    <p class="text-white font-bold text-2xl">API</p>
                </div>
            </a>
            <div class="space-x-7 flex items-center">
                <a href="Profile.php">
                    <img src="../assets/Img/user.png" class="w-10" alt="User Profile">
                </a>
                <a href="index.php" class="text-VeryLightGray">
                    <button class="border-2 px-3 py-2 rounded-lg border-LightGray hover:border-gray-400 transition-all">Login</button>
                </a>
                <a href="SignUp.php" class="text-VeryLightGray">
                    <button class="border-2 px-3 py-2 rounded-lg border-LightGray hover:border-gray-400 transition-all">Sign-Up</button>
                </a>
            </div>
        </div>
    </nav>
    <?php if (!isset($_SESSION['$MakeAccount'])): ?>
        <div class="bg-gray-800 mt-12 p-6 rounded-lg shadow-lg w-full max-w-md text-white text-center">
            <div class="flex justify-center">
                <img src="../assets/Img/user.png" alt="User Profile" class="w-24 h-24 rounded-full border-2 border-white">
            </div>
            <div class="mt-4">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <h2 class="text-2xl font-bold"><?php echo $row['username'] ?></h2>
                    <p class="text-gray-400 mt-2">Email: <?php echo $row['email'] ?></p>
                    <p class="text-gray-400 mt-1">Age : <?php echo $row['age'] ?></p>
                <?php endwhile ?>
            </div>
            <div class="flex justify-center space-x-4 mt-6">
                <a href="./handlers/editProfile.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg transition duration-300 hover:bg-blue-600">Edit Profile</a>
                <a href="./handlers/Logout.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg transition duration-300 hover:bg-blue-600">Log out</a>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  mt-5">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            quiz_type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            score
                        </th>
                        <th scope="col" class="px-6 py-3">
                            quiz_date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row_1 = $result_1->fetch_assoc()): ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                            <th scope=" row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $row_1['quiz_type'] ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $row_1['score'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row_1['quiz_date'] ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</body>

</html>
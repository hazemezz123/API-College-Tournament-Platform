<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("./handlers/Connection.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="build.css">
</head>

<body class=" bg-gray-900  max-md:h-full  text-VeryLightGray bg-no-repeat infinite-gradient">
    <!-- Navbar -->
    <nav class="bg-slate-900 shadow-2xl border-b-2 border-b-VeryLightGray">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../Tournament_Students/public/Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../assets/img/API (2).png" class=" w-24 border-r-2 pr-2" alt="School Logo">
                    <p class="text-white font-bold text-2xl">API</p>
                </div>
            </a>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="container mx-auto mt-10 flex flex-wrap justify-center gap-8 px-4">
        <form action="./handlers/process_LogIn.php" method="POST" class="w-full sm:w-2/3 lg:w-1/2 p-6 rounded-lg shadow-md bg-gray-800 hover:border-blue-500 transition-all  border border-transparent">
            <h2 class="text-2xl font-bold mb-4 text-gray-100">Login to Your Account</h2>
            <!-- Username Input -->
            <div class="mb-4">
                <label for="username" class="block text-gray-400 pb-2">Username</label>
                <input type="text" id="username" name="username" required
                    class="border border-slate-700 rounded w-full py-2 px-3 bg-slate-800 text-gray-100 focus:ring-4 focus:ring-blue-500 focus:outline-none transition-all">
            </div>
            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-gray-400 pb-2">Password</label>
                <input type="password" id="password" name="password" required
                    class="border border-slate-700 rounded w-full py-2 px-3 bg-slate-800 text-gray-100 focus:ring-4 focus:ring-blue-500 focus:outline-none transition-all">
            </div>
            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-gray-400 pb-2">Email</label>
                <input type="email" id="email" name="email" required
                    class="border border-slate-700 rounded w-full py-2 px-3 bg-slate-800 text-gray-100 focus:ring-4 focus:ring-blue-500 focus:outline-none transition-all">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="text-red-500 p-2">
                        <?php echo $_SESSION['error'];
                        session_unset(); ?>
                    </div>
                <?php endif ?>
            </div>
            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row gap-5 items-center justify-start mt-4">
                <button type="submit" class="text-white transition-all  border bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2     dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Submit</button>
                <span class="text-gray-100">Don't Have an Account?
                    <a href="SignUp.php" class="text-blue-500 underline hover:text-blue-300 transition-all">Create account</a>
                </span>
            </div>
        </form>
        <!-- About Section -->
        <div class="w-full h-[300px] sm:w-2/3 lg:w-1/3 p-6 rounded-lg shadow-md bg-gray-800 text-VeryLightGray mb-10 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-4">About the Student Tournament</h2>
                <p class="text-SoftGray mb-5">Join the exciting Student Tournament where students from various schools compete in sports, academics, and arts! Stay tuned for the next tournament dates and events. Winners will receive special recognition and prizes!</p>
            </div>
            <a href="tournament_details.php">
                <button type="button" class="text-white transition-all border bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Learn more</button>
            </a>
        </div>

    </div>
    <footer class="bg-white rounded-lg  dark:bg-gray-900 m-4   ">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="../assets/Img/API (2).png" class="h-20" alt="Api Collage" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Api Collage</span>
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="./index.php" class="hover:underline me-4 md:me-6">Login</a>
                    </li>
                    <li>
                        <a href="./SignUp.php" class="hover:underline me-4 md:me-6 ">SignUp</a>
                    </li>
                    <li>
                        <a href="./tournament_details.php" class="hover:underline me-4 md:me-6 capitalize">tournament details</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="#" class="hover:underline">Api Collage</a>. All Rights Reserved.</span>
        </div>
    </footer>

</body>

</html>
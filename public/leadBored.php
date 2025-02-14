<!DOCTYPE html>
<html lang="en">
<!-- Get the quiz scores of the all users depends on the user_id of each (quiz)  -->

<head>
    <?php
    session_start();
    if (isset($_COOKIE['user_id'])) {
        include("./handlers/Connection.php");
        checkUserLoggedIn();
    }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build.css">
    <title>Document</title>
</head>

<body class="bg-[#111827]">
    <nav class="bg-gray-900 shadow-2xl border-b ">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center ">
            <a href="../../Tournament_Students/public/Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../assets/img/API (2).png" class=" w-24 border-r-2 pr-2" alt="School Logo">
                    <p class="text-white font-bold text-2xl">API</p>
                </div>
            </a>
            <div class="space-x-7 flex justify-center items-center">
                <a href="./leadBored.php" class=" me-4 md:me-6 capitalize text-VeryLightGray border p-2 rounded-xl">leadbored</a>
                <a href="Profile.php">
                    <img src="../assets/Img/user.png" class="w-10" alt="">
                </a>
                <a href="index.php" class=" text-VeryLightGray">
                    <button class="border-2 px-3 py-2 rounded-lg border-LightGray hover:border-gray-400 transition-all">Login</button>
                </a>
                <a href="SignUp.php" class=" text-VeryLightGray">
                    <button class="border-2 px-3 py-2 rounded-lg border-LightGray hover:border-gray-400 transition-all">Sign-Up</button>
                </a>
            </div>
        </div>
    </nav>
    <div class="relative overflow-x-hidden mx-10">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  mt-5  ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        name
                    </th>
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
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                    <th scope=" row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    </th>
                    <th scope=" row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    </th>
                    <td class="px-6 py-4">
                    </td>
                    <td class="px-6 py-4">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
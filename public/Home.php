<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("./handlers/Connection.php");

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="build.css">
    <style>
        @keyframes gradientScroll {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 0% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        .infinite-gradient {
            background-size: 150% 150%;
            animation: gradientScroll 10s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-DarkBackGround">
    <nav class="bg-DarkGray shadow-2xl border-b-VeryLightGray">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../El e2tmad/public/Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../assets/img/school.png" class="w-14" alt="School Logo">
                    <p class="text-VeryLightGray font-bold">Student_Tournament</p>
                </div>
            </a>

            <div class="space-x-7">
                <a href="index.php" class=" text-VeryLightGray">
                    <button class="border-2 px-3 py-2 rounded-lg border-LightGray hover:border-gray-400 transition-all">login</button>
                </a>
                <a href="SignUp.php" class=" text-VeryLightGray">
                    <button class="border-2 px-3 py-2 rounded-lg border-LightGray hover:border-gray-400 transition-all">Sign-Up</button>
                </a>
            </div>
        </div>
    </nav>
    <div>
        <header class="text-center uppercase font-extrabold text-5xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 mt-14 leading-relaxed shadow-lg">
            Welcome to the Student Tournament
            <br>
            For The Intelligence
        </header>

        <section class="grid grid-cols-3 mt-20 mx-20 gap-5">
            <div class="border-2 border-VeryLightGray text-VeryLightGray p-2">
                <h1 class="text-2xl m-2 mt-4">Programming Solving:</h1>
                <p class="p-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis error assumenda voluptatem.</p>
                <div class="space-x-2.5 m-2">
                    <a href="../../El e2tmad/public/Quiz_Programming.php">
                        <button class="px-4 py-2 bg-transparent rounded text-VeryLightGray border-2 border-VeryLightGray hover:bg-VeryLightGray hover:text-DarkBackGround transition-all hover:scale-95">Start Now</button>
                    </a>
                    <button class="px-4 py-2 bg-VeryLightGray rounded text-DarkBackGround  border-2 hover:bg-transparent hover:text-VeryLightGray transition-all hover:scale-95">More information</button>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
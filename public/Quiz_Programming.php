<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require("./handlers/Connection.php")
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./build.css">
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

<body class="overflow-hidden bg-gradient-to-br h-screen  from-black via-DarkForestGreen to-emerald-800 text-VeryLightGray bg-no-repeat   infinite-gradient">
    <nav class="bg-DarkBackGround shadow-2xl  border-b-2 border-b-VeryLightGray">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../El e2tmad/public/Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../assets/img/school.png" class="w-14" alt="School Logo">
                    <p class="text-VeryLightGray font-bold">Student_Tournament</p>
                </div>
            </a>
        </div>
    </nav>
    <section class="h-screen flex justify-center items-center">
        <figure class="p-10 border-1 border-gray-400 bg-DarkGray rounded-lg">
            <div class="text-3xl text-center p-5">
                <h1>What is the Best programming language You learn ? </h1>
            </div>
            <div class="flex justify-center items-center flex-col gap-5">
                <button class="px-4 py-2 hover:bg-[#121212] transition-all border-2 w-full text-start border-gray-400 bg-DarkForestGreen  ">
                    hello world from the quiz ??
                </button>
                <button class="px-4 py-2 hover:bg-[#121212] transition-all  border-2 w-full text-start border-gray-400 bg-DarkForestGreen  ">
                    hello world from the quiz ??
                </button>
                <button class="px-4 py-2 hover:bg-[#121212]  transition-all  border-2 w-full text-start border-gray-400 bg-DarkForestGreen ">
                    hello world from the quiz ??
                </button>
                <button class="px-4 py-2 hover:bg-[#121212]  transition-all border-2 w-full text-start border-gray-400 bg-DarkForestGreen  ">
                    hello world from the quiz ??
                </button>
                <div class="">
                    <button class="border rounded   py-2 px-3 bg-DarkGray text-VeryLightGray hover:bg-VeryLightGray hover:text-black transition-all">Submit</button>
                </div>
            </div>
        </figure>
    </section>
</body>

</html>
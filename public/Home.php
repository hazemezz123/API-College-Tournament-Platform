<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("./handlers/Connection.php");
checkUserLoggedIn();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="build.css">
    <link rel="stylesheet" href="../src/styles.css">
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

<body class="bg-[#111827]">
    <nav class="bg-gray-900 shadow-2xl border-b ">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center ">
            <a href="../../El e2tmad/public/Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../assets/img/API (2).png" class=" w-24 border-r-2 pr-2" alt="School Logo">
                    <p class="text-white font-bold text-2xl">API</p>
                </div>
            </a>
            <div class="space-x-7 flex justify-center items-center">
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
    <div>
        <header class="text-center uppercase font-extrabold text-5xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 mt-14 leading-relaxed ">
            Welcome to the Student Tournament
            <br>
            For The Intelligence Programmers
        </header>
        <section class="grid grid-cols-3 my-20 mx-20 gap-5 max-md:flex max-md:flex-col">
            <!-- PHP quiz Section -->
            <div class="max-w-sm bg-white dark:bg-gray-800 border-2 border-gray-300 transition-all dark:border-gray-700 rounded-lg shadow-lg   border-transparent  hover:border-2 hover:border-gray-300 hover:shadow-2xl relative">
                <a href="#" class="flex justify-center items-center p-5">
                    <img class="rounded-lg w-40 h-40 object-contain rotate-php" src="../assets/Img/php.png" alt="PHP Quiz" />
                </a>
                <hr>
                <div class="p-6 flex flex-col justify-between">
                    <div>
                        <h5 class="mb-2 text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">PHP Quiz</h5>
                        <p class="mb-4 text-sm font-medium text-gray-700 dark:text-gray-400">Test your fundamental knowledge of PHP programming. This quiz covers basic syntax, functions, and more.</p>
                    </div>
                    <ul class="mb-4 text-sm text-gray-700 dark:text-gray-400">
                        <li><span class="font-semibold">Total Questions:</span> 10</li>
                        <li><span class="font-semibold">Estimated Time:</span> 10-15 minutes</li>
                        <li><span class="font-semibold">Difficulty Level:</span> Beginner</li>
                    </ul>
                    <figure class="flex items-center justify-between">
                        <a href="../../El e2tmad/public/Quiz_php.php?question_Type=php" class="group inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 transition-all">
                            Take Quiz
                            <svg class="w-4 h-4 ml-2 rtl:rotate-180 group-hover:translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                        <p class="text-gray-900 dark:text-white font-bold text-lg">Points: 10</p>
                    </figure>
                </div>
            </div>
            <!-- Html Quiz Section -->
            <div class="max-w-sm bg-white dark:bg-gray-800 border-2 border-gray-300 transition-all dark:border-gray-700 rounded-lg shadow-lg   border-transparent  hover:border-2 hover:border-gray-300 hover:shadow-2xl">
                <a href="#" class="flex justify-center items-center p-5">
                    <img class="rounded-lg w-40 h-40 object-contain" src="../assets/Img/html.png" alt="PHP Quiz" />
                </a>
                <hr>
                <div class="p-6 flex flex-col justify-between">
                    <div>
                        <h5 class="mb-2 text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">HTML Quiz</h5>
                        <p class="mb-4 text-sm font-medium text-gray-700 dark:text-gray-400">Test your knowledge of HTML basics, including structure, elements, and attributes. Perfect for beginners and those looking to refresh their skills!</p>
                    </div>
                    <ul class="mb-4 text-sm text-gray-700 dark:text-gray-400">
                        <li><span class="font-semibold">Total Questions:</span> 10</li>
                        <li><span class="font-semibold">Estimated Time:</span> 10-15 minutes</li>
                        <li><span class="font-semibold">Difficulty Level:</span> Beginner</li>
                    </ul>
                    <figure class="flex items-center justify-between">
                        <a href="../../El e2tmad/public/Quiz_php.php?question_Type=html" class="group inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 transition-all">
                            Take Quiz
                            <svg class="w-4 h-4 ml-2 rtl:rotate-180 group-hover:translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                        <p class="text-gray-900 dark:text-white font-bold text-lg">Points: 10</p>
                    </figure>
                </div>
            </div>
            <!-- Msql Quiz -->
            <div class="max-w-sm bg-white dark:bg-gray-800 border-2 border-gray-300 transition-all dark:border-gray-700 rounded-lg shadow-lg   border-transparent  hover:border-2 hover:border-gray-300 hover:shadow-2xl">
                <a href="#" class="flex justify-center items-center p-5">
                    <img class="rounded-lg w-40 h-40 object-contain" src="../assets/Img/language.png" alt="PHP Quiz" />
                </a>
                <hr>
                <div class="p-6 flex flex-col justify-between">
                    <div>
                        <h5 class="mb-2 text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">MySQL Quiz</h5>
                        <p class="mb-4 text-sm font-medium text-gray-700 dark:text-gray-400">Test your knowledge of MySQL fundamentals, including queries, databases, and table management.</p>
                    </div>
                    <ul class="mb-4 text-sm text-gray-700 dark:text-gray-400">
                        <li><span class="font-semibold">Total Questions:</span> 10</li>
                        <li><span class="font-semibold">Estimated Time:</span> 10-15 minutes</li>
                        <li><span class="font-semibold">Difficulty Level:</span> Beginner</li>
                    </ul>
                    <figure class="flex items-center justify-between">
                        <a href="../../El e2tmad/public/Quiz_php.php?question_Type=mysql" class="group inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 transition-all">
                            Take Quiz
                            <svg class="w-4 h-4 ml-2 rtl:rotate-180 group-hover:translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                        <p class="text-gray-900 dark:text-white font-bold text-lg">Points: 10</p>
                    </figure>
                </div>
            </div>
            <!-- React.js quiz -->
            <div class="max-w-sm bg-white dark:bg-gray-800 border-2 border-gray-300 transition-all dark:border-gray-700 rounded-lg shadow-lg   border-transparent  hover:border-2 hover:border-gray-300 hover:shadow-2xl">
                <a href="#" class="flex justify-center items-center p-5">
                    <img class="rounded-lg w-40 h-40 object-contain rotate-animation" src="../assets/Img/structure.png" alt="PHP Quiz" />
                </a>
                <hr>
                <div class="p-6 flex flex-col justify-between">
                    <div>
                        <h5 class="mb-2 text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">React.js Quiz</h5>
                        <p class="mb-4 text-sm font-medium text-gray-700 dark:text-gray-400">Test your knowledge of React.js basics, including components, state management, React-Props , and hooks.</p>
                    </div>
                    <ul class="mb-4 text-sm text-gray-700 dark:text-gray-400">
                        <li><span class="font-semibold">Total Questions:</span> 10</li>
                        <li><span class="font-semibold">Estimated Time:</span> 10-15 minutes</li>
                        <li><span class="font-semibold">Difficulty Level:</span> Beginner</li>
                    </ul>
                    <figure class="flex items-center justify-between">
                        <a href="../../El e2tmad/public/Quiz_php.php?question_Type=react.js" class="group inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 transition-all">
                            Take Quiz
                            <svg class="w-4 h-4 ml-2 rtl:rotate-180 group-hover:translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                        <p class="text-gray-900 dark:text-white font-bold text-lg">Points: 10</p>
                    </figure>
                </div>
            </div>
            <!-- Css quiz -->
            <div class="max-w-sm bg-white dark:bg-gray-800 border-2 border-gray-300 transition-all dark:border-gray-700 rounded-lg shadow-lg   border-transparent  hover:border-2 hover:border-gray-300 hover:shadow-2xl">
                <a href="#" class="flex justify-center items-center p-5">
                    <img class="rounded-lg w-40 h-40 object-contain" src="../assets/Img/css-3.png" alt="PHP Quiz" />
                </a>
                <hr>
                <div class="p-6 flex flex-col justify-between">
                    <div>
                        <h5 class="mb-2 text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">CSS Quiz</h5>
                        <p class="mb-4 text-sm font-medium text-gray-700 dark:text-gray-400">Test your knowledge of CSS fundamentals, including selectors, properties, and layout techniques.</p>
                    </div>
                    <ul class="mb-4 text-sm text-gray-700 dark:text-gray-400">
                        <li><span class="font-semibold">Total Questions:</span> 10</li>
                        <li><span class="font-semibold">Estimated Time:</span> 10-15 minutes</li>
                        <li><span class="font-semibold">Difficulty Level:</span> Beginner</li>
                    </ul>
                    <figure class="flex items-center justify-between">
                        <a href="../../El e2tmad/public/Quiz_php.php?question_Type=css" class="group inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 transition-all">
                            Take Quiz
                            <svg class="w-4 h-4 ml-2 rtl:rotate-180 group-hover:translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                        <p class="text-gray-900 dark:text-white font-bold text-lg">Points: 10</p>
                    </figure>
                </div>
            </div>
            <!-- Python quiz -->
            <div class="max-w-sm bg-white dark:bg-gray-800 border-2 border-gray-300 transition-all dark:border-gray-700 rounded-lg shadow-lg   border-transparent  hover:border-2 hover:border-gray-300 hover:shadow-2xl">
                <a href="#" class="flex justify-center items-center p-5 rotate-animation">
                    <img class="rounded-lg w-40 h-40 object-contain " src="../assets/Img/python.png" alt="PHP Quiz" />
                </a>
                <hr>
                <div class="p-6 flex flex-col justify-between">
                    <div>
                        <h5 class="mb-2 text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Python Quiz</h5>
                        <p class="mb-4 text-sm font-medium text-gray-700 dark:text-gray-400">Test your knowledge of Python basics, including syntax, data types, loops , Operators , RegEx, and functions.</p>
                    </div>
                    <ul class="mb-4 text-sm text-gray-700 dark:text-gray-400">
                        <li><span class="font-semibold">Total Questions:</span> 10</li>
                        <li><span class="font-semibold">Estimated Time:</span> 10-15 minutes</li>
                        <li><span class="font-semibold">Difficulty Level:</span> Beginner</li>
                    </ul>
                    <figure class="flex items-center justify-between">
                        <a href="../../El e2tmad/public/Quiz_php.php?question_Type=python" class="group inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 transition-all">
                            Take Quiz
                            <svg class="w-4 h-4 ml-2 rtl:rotate-180 group-hover:translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                        <p class="text-gray-900 dark:text-white font-bold text-lg">Points: 10</p>
                    </figure>
                </div>
            </div>
        </section>
    </div>
    <footer class="bg-white rounded-lg  dark:bg-gray-900 m-4  shadow-white ">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
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
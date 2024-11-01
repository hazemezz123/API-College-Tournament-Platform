<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require("./handlers/Connection.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="build.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../src/styles.css">
    <style>
        label {
            text-transform: capitalize;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

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

        /* Initially hide the team selection dropdown */
        #teamSelect {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-900 max-md:h-full text-VeryLightGray bg-no-repeat infinite-gradient">
    <nav class="bg-slate-900 shadow-2xl border-b-2 border-b-VeryLightGray">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../El e2tmad/public/Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../assets/img/API (2).png" class="w-24 border-r-2 pr-2" alt="School Logo">
                    <p class="text-white font-bold text-2xl">API</p>
                </div>
            </a>
        </div>
    </nav>
    <main class="flex justify-center items-center w-full">
        <form action="handlers/process_SignUp.php" method="POST" class="p-6 w-[600px] mt-10 mb-10 rounded-lg shadow-md bg-gray-800 hover:border-blue-500 transition-all border border-transparent">
            <h2 class="text-2xl font-bold mb-4 text-VeryLightGray">Create a new Account</h2>
            <!-- Username Input -->
            <div class="mb-4">
                <label for="username" class="block text-SoftGray pb-2">Username</label>
                <div class="relative">
                    <input autocomplete="off" type="text" id="username" name="username" required class="border border-slate-700 rounded w-full py-2 px-3 bg-slate-800 text-gray-100 focus:ring-4 focus:ring-blue-500 focus:outline-none transition-all">
                    <span>
                        <i class="fa-solid fa-user absolute top-1/2 -translate-y-1/2 right-3"></i>
                    </span>
                </div>
            </div>
            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-SoftGray pb-2">Email</label>
                <div class="relative">
                    <input autocomplete="off" type="email" id="email" name="email" required class="border border-slate-700 rounded w-full py-2 px-3 bg-slate-800 text-gray-100 focus:ring-4 focus:ring-blue-500 focus:outline-none transition-all">
                    <span>
                        <i class="fa-solid fa-envelope absolute top-1/2 -translate-y-1/2 right-3"></i>
                    </span>
                </div>
            </div>
            <!-- Age Input -->
            <div class="mb-4">
                <label for="age" class="block text-SoftGray pb-2">Age</label>
                <div class="relative">
                    <input autocomplete="off" min='19' max="25" type="number" id="age" name="age" required class="border border-slate-700 rounded w-full py-2 px-3 bg-slate-800 text-gray-100 focus:ring-4 focus:ring-blue-500 focus:outline-none transition-all">
                    <span>
                        <i class="fa-solid fa-circle-info absolute top-1/2 -translate-y-1/2 right-3"></i>
                    </span>
                </div>
            </div>
            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-SoftGray pb-2">Password</label>
                <div class="relative">
                    <input autocomplete="off" type="password" id="password" name="password" required class="border border-slate-700 rounded w-full py-2 px-3 bg-slate-800 text-gray-100 focus:ring-4 focus:ring-blue-500 focus:outline-none transition-all">
                    <span>
                        <i id="togglePassword" class="fa-solid fa-lock absolute top-1/2 -translate-y-1/2 right-3 cursor-pointer"></i>
                    </span>
                </div>
            </div>
            <div class="my-4 flex gap-5">
                <div class="flex justify-center items-center">
                    <input type="radio" name="participation_type" value="individual" required id="individual" checked>
                    <label for="individual" class="text-SoftGray cursor-pointer">Individual</label>
                </div>
                <div class="flex justify-center items-center">
                    <input type="radio" name="participation_type" value="team" required id="team">
                    <label for="team" class="text-SoftGray cursor-pointer">Team</label>
                </div>
            </div>
            <!-- Team Selection Dropdown -->
            <div id="teamSelect">
                <label for="teamSelectDropdown" class="block text-SoftGray pb-2">Select Your Team</label>
                <select id="teamSelectDropdown" name="team" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-all p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 block w-full">
                    <option selected disabled>Select Team</option>
                    <option value="1">Team_1</option>
                    <option value="2">Team_2</option>
                    <option value="3">Team_3</option>
                    <option value="4">Team_4</option>
                </select>
            </div>
            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row gap-5 items-center justify-start mt-4">
                <button type="submit" class="text-white transition-all border bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Sign Up</button>
            </div>
            <?php
            if (isset($_SESSION['Submit'])) {
                echo $_SESSION['Submit'];
            }
            ?>
        </form>
    </main>
    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("password");
        togglePassword.addEventListener("click", function() {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            togglePassword.classList.toggle("fa-lock-open");
            togglePassword.classList.toggle("fa-lock");
        });

        // JavaScript to show/hide team selection dropdown
        const individualRadio = document.getElementById("individual");
        const teamRadio = document.getElementById("team");
        const teamSelect = document.getElementById("teamSelect");

        individualRadio.addEventListener("change", function() {
            teamSelect.style.display = "none";

        });

        teamRadio.addEventListener("change", function() {
            teamSelect.style.display = "block";
        });
    </script>
</body>

</html>
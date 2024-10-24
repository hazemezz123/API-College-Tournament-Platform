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
    </style>
</head>

<body class="overflow-hidden bg-gradient-to-br from-black via-DarkBackGround to-DarkForestGreen text-VeryLightGray bg-no-repeat h-screen infinite-gradient">
    <nav class="bg-DarkGray shadow-2xl  border-b-2 border-b-VeryLightGray">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../El e2tmad/public/Home.php">
                <div class="flex space-x-4 justify-center items-center">
                    <img src="../assets/Img/school.png" class="w-14" alt="School Logo">
                    <p class="text-VeryLightGray font-bold">Student_Tournament</p>
                </div>
            </a>
        </div>
    </nav>
    <main class="h-[calc(100vh-89px)] flex justify-center items-center w-full">
        <form action="handlers/process_SignUp.php" method="POST" class="p-6 rounded-lg shadow-md bg-BlackOlive green-glowing-box" style="width: 50%;">
            <h2 class="text-2xl font-bold mb-4 text-VeryLightGray">Create a new Account</h2>
            <!-- Username Input -->
            <div class="mb-4">
                <label for="username" class="block text-SoftGray pb-2">Username</label>
                <div class="relative">
                    <input autocomplete="off" type="text" id="username" name="username" required class="border rounded w-full py-2 px-3 bg-DarkGray text-VeryLightGray focus:ring-4 focus:ring-VeryLightGray focus:ring-opacity-50 focus:outline-none transition-all">
                    <span>
                        <i class="fa-solid fa-user absolute top-1/2 -translate-y-1/2 right-3"></i>
                    </span>
                </div>
            </div>
            <!-- email Input -->
            <div class="mb-4">
                <label for="password" class="block text-SoftGray pb-2">email</label>
                <div class="relative">
                    <input autocomplete="off" type="email" id="email" name="email" required class="border rounded w-full py-2 px-3 bg-DarkGray text-VeryLightGray focus:ring-4 focus:ring-VeryLightGray focus:ring-opacity-50 focus:outline-none transition-all ">
                    <span>
                        <i class="fa-solid fa-envelope absolute top-1/2 -translate-y-1/2 right-3"></i>
                    </span>
                </div>
            </div>
            <!-- Age Input -->
            <div class="mb-4">
                <label for="age" class="block text-SoftGray pb-2">age</label>
                <div class="relative">
                    <input autocomplete="off" min='19' max="25" type="number" id="age" name="age" required class="border rounded w-full py-2 px-3 bg-DarkGray text-VeryLightGray focus:ring-4 focus:ring-VeryLightGray focus:ring-opacity-50 focus:outline-none transition-all ">
                    <span>
                        <i class="fa-solid fa-circle-info absolute top-1/2 -translate-y-1/2 right-3"></i>
                    </span>
                </div>
            </div>
            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-SoftGray pb-2">Password</label>
                <div class="relative">
                    <input autocomplete="off" type="password" id="password" name="password" required class="border rounded w-full py-2 px-3 bg-DarkGray text-VeryLightGray focus:ring-4 focus:ring-VeryLightGray focus:ring-opacity-50 focus:outline-none transition-all">
                    <span>
                        <i id="togglePassword" class="fa-solid fa-lock absolute top-1/2 -translate-y-1/2 right-3 cursor-pointer"></i>
                    </span>
                </div>
            </div>
            <div class="my-4 flex gap-5">
                <div class="flex justify-center items-center">
                    <input type="radio" name="participation_type" value="individual" required>
                    individual
                </div>
                <div class="flex justify-center items-center">
                    <input type="radio" name="participation_type" value="team" required>
                    team
                </div>
            </div>
            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row gap-5 items-center justify-start mt-4">
                <?php if (isset($_SESSION['Submit'])): ?>
                    <?php
                    echo $_SESSION['Submit'];
                    session_unset();
                    ?>
                <?php endif ?>
                <!-- Sign Up Button -->
                <button type="submit" class="border-VeryLightGray border-2 text-VeryLightGray py-2 px-6 rounded-lg hover:scale-95 hover:bg-VeryLightGray hover:text-DarkBackGround transition-all shadow-md hover:shadow-lg">
                    Sign Up
                </button>

    </main>
    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("password");
        togglePassword.addEventListener("click", function() {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            if (type === "text") {
                togglePassword.classList.replace("fa-lock", "fa-lock-open");
            } else {
                togglePassword.classList.replace("fa-lock-open", "fa-lock");
            }
        });
    </script>
</body>

</html>
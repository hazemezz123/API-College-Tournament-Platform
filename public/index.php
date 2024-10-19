<!DOCTYPE html>
<html lang="en">

<head>
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
            animation: gradientScroll 20s ease-in-out infinite;
        }
    </style>
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="build.css">
</head>

<body class="overflow-hidden bg-gradient-to-br from-black via-DarkForestGreen to-emerald-800 text-VeryLightGray bg-no-repeat h-screen infinite-gradient">
    <!-- Navbar -->
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
    <!-- Main Content -->
    <div class="container mx-auto mt-10 flex gap-20 justify-center ">
        <form action="./handlers/process_LogIn.php" method="POST" class=" p-6 rounded-lg shadow-md  bg-BlackOlive" style="width: 50%;">
            <h2 class="text-2xl font-bold mb-4 text-VeryLightGray">Login to Your Account</h2>
            <!-- Username Input -->
            <div class="mb-4">
                <label for="username" class="block text-SoftGray pb-2">Username</label>
                <input autocomplete="FALSE" type="text" id="username" name="username" required class="border rounded w-full py-2 px-3 bg-DarkGray text-VeryLightGray focus:ring-4 focus:ring-VeryLightGray focus:ring-opacity-50 focus:outline-none transition-all">
            </div>
            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-SoftGray pb-2">Password</label>
                <input autocomplete="FALSE" type="password" id="password" name="password" required class="border rounded w-full py-2 px-3 bg-DarkGray text-VeryLightGray focus:ring-4 focus:ring-VeryLightGray focus:ring-opacity-50 focus:outline-none transition-all">
            </div>
            <!-- email Input -->
            <div class="mb-4">
                <label for="password" class="block text-SoftGray pb-2">email</label>
                <input autocomplete="FALSE" type="email" id="email" name="email" required class="border rounded w-full py-2 px-3 bg-DarkGray text-VeryLightGray focus:ring-4 focus:ring-VeryLightGray focus:ring-opacity-50 focus:outline-none transition-all">
            </div>
            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row gap-5 items-center justify-start mt-4">
                <!-- Login Button -->
                <button type="submit" class="border-VeryLightGray border-2 text-VeryLightGray py-2 px-6 rounded-lg hover:scale-95 hover:bg-VeryLightGray hover:text-DarkBackGround transition-all shadow-md hover:shadow-lg">
                    Login
                </button>
                <!-- Sign-up Link -->
                <span class="text-VeryLightGray">
                    Create an <a href="SignUp.php" class="text-blue-500 underline hover:text-blue-300 transition-all">new account</a>
                </span>
            </div>

        </form>
        <!-- Student Tournament Section -->
        <div class="container mx-auto mt-10 p-6 rounded-lg shadow-md bg-DarkBackGround flex justify-between flex-col">
            <div>
                <h2 class="text-2xl font-bold mb-4 text-VeryLightGray">About the Student Tournament</h2>
                <p class="text-SoftGray mb-4">
                    Join the exciting Student Tournament where students from various schools compete in sports, academics, and arts!
                    Stay tuned for the next tournament dates and events. Winners will receive special recognition and prizes!
                </p>
            </div>
            <div class="mb-4.5">
                <a href="tournament_details.php" class="border-VeryLightGray border-2 text-VeryLightGray py-2 px-4  rounded hover:scale-95 transition-all hover:bg-VeryLightGray hover:text-DarkBackGround">
                    Learn More
                </a>
            </div>

        </div>
    </div>

</body>

</html>
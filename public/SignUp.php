<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(__DIR__ . "/handlers/Connection.php");

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and validate input
    $username = Validate($_POST["username"]);
    $email = Validate($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $full_name = Validate($_POST["full_name"]);
    $age = Validate($_POST["age"]);
    $bio = Validate($_POST["bio"]);
    $membership_type = Validate($_POST["membership_type"]);
    $team_type = Validate($_POST["team_type"]);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    }
    // Check if passwords match
    elseif ($password !== $confirm_password) {
        $error = "Passwords do not match";
    }
    // Check password strength
    elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
    }
    // Validate team type selection
    elseif (empty($team_type)) {
        $error = "Please select a team type";
    }
    else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = "Email already registered";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, full_name, age, bio, membership_type, team_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $username, $email, $hashed_password, $full_name, $age, $bio, $membership_type, $team_type);
            
            if ($stmt->execute()) {
                $success = "Registration successful! Please login.";
                // Redirect to login page after 2 seconds
                header("refresh:2;url=index.php");
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="/build.css">
</head>
<body class="bg-[#1a1f2e] text-white">
    <div class="container mx-auto px-4">
        <!-- Header with logo and buttons -->
        <header class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <img src="assets/Img/API (2).png" alt="API College Logo" class="h-8 w-8 mr-2">
                <span class="text-xl font-semibold">API College</span>
            </div>
            <div>
                <a href="index.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md mr-2">Login</a>
                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Sign Up</button>
            </div>
        </header>

        <!-- Main content -->
        <div class="min-h-[calc(100vh-8rem)] flex flex-col items-center justify-center">
            <h1 class="text-4xl font-bold text-center mb-2 text-blue-400">Welcome to API College Student Tournament</h1>
            <p class="text-gray-400 text-center mb-8">Test your programming skills, compete with peers, and showcase your knowledge in various technology domains.</p>

            <!-- Sign Up Form -->
            <div class="w-full max-w-md bg-[#1e2530] rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Create Your Account</h2>
                
                <?php if ($error): ?>
                    <div class="bg-red-900/50 border border-red-500 text-red-200 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline"><?php echo $error; ?></span>
                    </div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="bg-green-900/50 border border-green-500 text-green-200 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline"><?php echo $success; ?></span>
                    </div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium mb-1">Username</label>
                        <input id="username" name="username" type="text" required 
                               class="w-full px-3 py-2 bg-[#2a303c] border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Email</label>
                        <input id="email" name="email" type="email" required 
                               class="w-full px-3 py-2 bg-[#2a303c] border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium mb-1">Password</label>
                        <input id="password" name="password" type="password" required 
                               class="w-full px-3 py-2 bg-[#2a303c] border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="confirm_password" class="block text-sm font-medium mb-1">Confirm Password</label>
                        <input id="confirm_password" name="confirm_password" type="password" required 
                               class="w-full px-3 py-2 bg-[#2a303c] border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="full_name" class="block text-sm font-medium mb-1">Full Name</label>
                        <input id="full_name" name="full_name" type="text" required 
                               class="w-full px-3 py-2 bg-[#2a303c] border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="age" class="block text-sm font-medium mb-1">Age</label>
                        <input id="age" name="age" type="number" required 
                               class="w-full px-3 py-2 bg-[#2a303c] border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="team_type" class="block text-sm font-medium mb-1">Team Type</label>
                        <select id="team_type" name="team_type" required 
                                class="w-full px-3 py-2 bg-[#2a303c] border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Team Type</option>
                            <option value="alpha">Alpha Team</option>
                            <option value="beta">Beta Team</option>
                            <option value="gamma">Gamma Team</option>
                            <option value="delta">Delta Team</option>
                        </select>
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-medium mb-1">Bio</label>
                        <textarea id="bio" name="bio" rows="3" 
                                  class="w-full px-3 py-2 bg-[#2a303c] border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div>
                        <label for="membership_type" class="block text-sm font-medium mb-1">Membership Type</label>
                        <select id="membership_type" name="membership_type" required 
                                class="w-full px-3 py-2 bg-[#2a303c] border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="individual">Individual</option>
                            <option value="team">Team</option>
                        </select>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Sign Up
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <p class="text-gray-400">
                        Already have an account? 
                        <a href="index.php" class="text-blue-400 hover:text-blue-300">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 
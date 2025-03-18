<?php
require_once(__DIR__ . "/../includes/config.php");
require_once("./handlers/Connection.php");

// Get all users with their total scores, ordered by score descending
$stmt = "SELECT 
            u.username,
            u.membership_type,
            u.team_type,
            COALESCE(SUM(qs.score), 0) as total_score,
            COUNT(DISTINCT qs.quiz_type) as quizzes_taken,
            COALESCE(AVG(qs.score), 0) as avg_score
        FROM users u
        LEFT JOIN quiz_scores qs ON u.id = qs.user_id
        GROUP BY u.id
        ORDER BY total_score DESC";

$result = mysqli_query($conn, $stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="build.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .leaderboard-bg {
            background-color: #111827;
            background-image: 
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.1), transparent 40%),
                radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.1), transparent 40%);
            min-height: 100vh;
        }

        .trophy-gold { color: #FFD700; }
        .trophy-silver { color: #C0C0C0; }
        .trophy-bronze { color: #CD7F32; }

        .leaderboard-card {
            background: rgba(30, 41, 59, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease;
        }

        .leaderboard-card:hover {
            transform: translateY(-5px);
        }

        .rank-badge {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .rank-1 {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #000;
        }

        .rank-2 {
            background: linear-gradient(135deg, #C0C0C0, #A9A9A9);
            color: #000;
        }

        .rank-3 {
            background: linear-gradient(135deg, #CD7F32, #8B4513);
            color: #fff;
        }

        .rank-other {
            background: rgba(55, 65, 81, 0.5);
            color: #fff;
        }

        .team-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .team-alpha {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
        }

        .team-beta {
            background: linear-gradient(135deg, #10B981, #059669);
        }

        .team-gamma {
            background: linear-gradient(135deg, #F59E0B, #D97706);
        }

        .team-delta {
            background: linear-gradient(135deg, #EF4444, #DC2626);
        }

        .stat-value {
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }
    </style>
</head>

<body class="leaderboard-bg">
    <?php include_once("layouts/new_nav.php"); ?>

    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Tournament Leaderboard</h1>
            <p class="text-gray-400">Compete with your peers and climb the ranks!</p>
        </div>

        <!-- Top 3 Players -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <?php
            $rank = 1;
            $top_players = [];
            while($row = mysqli_fetch_assoc($result)) {
                if ($rank <= 3) {
                    $top_players[] = $row;
                }
                $rank++;
            }
            
            // Reorder for display (2nd, 1st, 3rd)
            if (count($top_players) >= 3) {
                $display_order = [$top_players[1], $top_players[0], $top_players[2]];
            } else {
                $display_order = $top_players;
            }

            foreach($display_order as $index => $player) {
                $actual_rank = $index == 0 ? 2 : ($index == 1 ? 1 : 3);
                $scale_class = $actual_rank == 1 ? 'scale-110' : '';
                $trophy_color = $actual_rank == 1 ? 'trophy-gold' : ($actual_rank == 2 ? 'trophy-silver' : 'trophy-bronze');
                ?>
                <div class="flex justify-center">
                    <div class="leaderboard-card rounded-lg p-6 text-center <?php echo $scale_class; ?> w-full max-w-sm">
                        <div class="flex justify-center mb-4">
                            <div class="rank-badge rank-<?php echo $actual_rank; ?>">
                                <?php echo $actual_rank; ?>
                            </div>
                        </div>
                        <i class="fas fa-trophy <?php echo $trophy_color; ?> text-4xl mb-4"></i>
                        <h3 class="text-xl font-bold text-white mb-2"><?php echo htmlspecialchars($player['username']); ?></h3>
                        
                        <?php if ($player['team_type']): ?>
                            <span class="team-badge team-<?php echo strtolower($player['team_type']); ?> text-white">
                                <?php echo htmlspecialchars($player['team_type']); ?> Team
                            </span>
                        <?php endif; ?>

                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <p class="text-gray-400 text-sm">Total Score</p>
                                <p class="stat-value text-2xl text-blue-400"><?php echo number_format($player['total_score']); ?></p>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-400 text-sm">Avg Score</p>
                                <p class="stat-value text-2xl text-green-400"><?php echo number_format($player['avg_score'], 1); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <!-- Rest of the Leaderboard -->
        <div class="bg-gray-900/50 rounded-lg overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-800/50">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Rank</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Player</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Quizzes</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total Score</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Avg Score</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        <?php
                        mysqli_data_seek($result, 0);
                        $rank = 1;
                        while($row = mysqli_fetch_assoc($result)) {
                            if ($rank > 3) {
                                ?>
                                <tr class="hover:bg-gray-800/30 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="rank-badge rank-other w-8 h-8 text-sm">
                                            <?php echo $rank; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-white"><?php echo htmlspecialchars($row['username']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($row['team_type']): ?>
                                            <span class="team-badge team-<?php echo strtolower($row['team_type']); ?> text-white">
                                                <?php echo htmlspecialchars($row['team_type']); ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-gray-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-300"><?php echo $row['quizzes_taken']; ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-mono font-bold text-blue-400"><?php echo number_format($row['total_score']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-mono font-bold text-green-400"><?php echo number_format($row['avg_score'], 1); ?></div>
                                    </td>
                                </tr>
                                <?php
                            }
                            $rank++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html> 
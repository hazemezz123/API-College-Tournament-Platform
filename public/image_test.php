<?php
require_once(__DIR__ . "/../includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Test</title>
    <style>
        body { 
            background-color: #111827; 
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .image-item {
            background-color: #1f2937;
            padding: 10px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        img {
            max-width: 150px;
            max-height: 150px;
            object-fit: contain;
            margin-bottom: 10px;
        }
        h1 { text-align: center; margin-bottom: 20px; }
        p { margin: 5px 0; }
        .note { 
            background-color: #2563eb; 
            padding: 10px; 
            border-radius: 4px; 
            margin-bottom: 20px; 
        }
    </style>
</head>
<body>
    <h1>Image Test Page</h1>
    
    <div class="note">
        APP_URL is set to: <?php echo APP_URL; ?>
    </div>
    
    <div class="image-grid">
        <div class="image-item">
            <img src="<?php echo APP_URL; ?>/assets/Img/php.png" alt="PHP">
            <p>PHP</p>
        </div>
        
        <div class="image-item">
            <img src="<?php echo APP_URL; ?>/assets/Img/html.png" alt="HTML">
            <p>HTML</p>
        </div>
        
        <div class="image-item">
            <img src="<?php echo APP_URL; ?>/assets/Img/language.png" alt="MySQL">
            <p>MySQL</p>
        </div>
        
        <div class="image-item">
            <img src="<?php echo APP_URL; ?>/assets/Img/structure.png" alt="React">
            <p>React</p>
        </div>
        
        <div class="image-item">
            <img src="<?php echo APP_URL; ?>/assets/Img/css-3.png" alt="CSS">
            <p>CSS</p>
        </div>
        
        <div class="image-item">
            <img src="<?php echo APP_URL; ?>/assets/Img/python.png" alt="Python">
            <p>Python</p>
        </div>
        
        <div class="image-item">
            <img src="<?php echo APP_URL; ?>/assets/Img/API (2).png" alt="API College">
            <p>API College</p>
        </div>
        
        <div class="image-item">
            <img src="<?php echo APP_URL; ?>/assets/Img/user.png" alt="User">
            <p>User</p>
        </div>
    </div>
    
    <div style="margin-top: 20px;">
        <a href="<?php echo APP_URL; ?>/Home.php" style="color: #3b82f6; text-decoration: none;">Back to Home</a>
    </div>
</body>
</html> 
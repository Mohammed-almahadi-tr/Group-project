<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites - Art Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .favorite-item {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            position: relative;
        }
        .favorite-item img {
            max-width: 100%;
            height: auto;
        }
        .remove-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            margin-top: 10px;
            cursor: pointer;
        }
        .clear-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
        }
        .counter {
            text-align: center;
            font-size: 18px;
            margin: 20px 0;
        }
        .empty-message {
            text-align: center;
            font-size: 18px;
            margin: 50px 0;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>My Favorite Artworks</h1>
    
    <div class="counter">
        <?php
        $count = isset($_SESSION['favorites']) ? count($_SESSION['favorites']) : 0;
        echo "You have $count favorite artwork(s)";
        ?>
    </div>
    
    <?php if (isset($_SESSION['favorites']) && count($_SESSION['favorites']) > 0): ?>
        <div class="favorites-grid">
            <?php foreach ($_SESSION['favorites'] as $item): ?>
                <div class="favorite-item">
                    <img src="images/<?= $item['Path'] ?>" alt="<?= $item['Title'] ?>">
                    <h3><?= $item['Title'] ?></h3>
                    <a href="remove-favorites.php?ImageID=<?= $item['ImageID'] ?>" class="remove-btn">Remove</a>
                </div>
            <?php endforeach; ?>
        </div>
        
        <a href="remove-favorites.php?clear=1" class="clear-btn">Clear All Favorites</a>
    <?php else: ?>
        <div class="empty-message">
            <p>You don't have any favorite artworks yet.</p>
            <p><a href="browse-painting.php">Browse the gallery</a> to add some!</p>
        </div>
    <?php endif; ?>
    
    <p style="text-align: center;"><a href="browse-painting.php">Back to Gallery</a></p>
</body>
</html>
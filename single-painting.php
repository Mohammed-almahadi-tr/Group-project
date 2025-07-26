<?php
if (!isset($_GET['ImageID'])) {
    header("Location: browse-painting.php");
    exit();
}

// Database connection
$db = new mysqli('localhost', 'root', '', 'art_gallery');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$imageID = $db->real_escape_string($_GET['ImageID']);
$sql = "SELECT * FROM imagedetails WHERE ImageID = $imageID";
$result = $db->query($sql);

if ($result->num_rows == 0) {
    header("Location: browse-painting.php");
    exit();
}

$row = $result->fetch_assoc();
$exif = json_decode($row['Exif'], true);
$colors = json_decode($row['Colors'], true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['Title'] ?> - Art Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .painting-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .painting-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        .details {
            width: 100%;
            margin-bottom: 20px;
        }
        .colors {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }
        .color-box {
            width: 50px;
            height: 50px;
            border: 1px solid #000;
        }
        .favorite-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px 0;
        }
        .favorite-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="painting-container">
        <h1><?= $row['Title'] ?></h1>
        <img src="images/<?= $row['Path'] ?>" alt="<?= $row['Title'] ?>" class="painting-image">
        
        <div class="details">
            <h2>Camera Information</h2>
            <p><strong>Camera:</strong> <?= $exif['camera'] ?></p>
            <p><strong>Lens:</strong> <?= $exif['lens'] ?></p>
            <p><strong>Aperture:</strong> <?= $exif['aperture'] ?></p>
            <p><strong>Shutter Speed:</strong> <?= $exif['shutter'] ?></p>
            <p><strong>ISO:</strong> <?= $exif['iso'] ?></p>
        </div>
        
        <div class="details">
            <h2>Main Colors</h2>
            <div class="colors">
                <?php foreach ($colors as $color): ?>
                    <div class="color-box" style="background-color: <?= $color ?>;"></div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <a href="addToFavorites.php?ImageID=<?= $row['ImageID'] ?>&Title=<?= urlencode($row['Title']) ?>&Path=<?= urlencode($row['Path']) ?>" class="favorite-btn">Add to Favorites</a>
        
        <a href="browse-painting.php">Back to Gallery</a>
    </div>
</body>
</html>

<?php $db->close(); ?>
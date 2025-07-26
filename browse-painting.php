<?php
// Database connection
$db = new mysqli('localhost', 'root', '', 'art_gallery');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Fetch all images
$sql = "SELECT * FROM imagedetails";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery - Browse Paintings</title>
    <style>
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .artwork {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .artwork img {
            max-width: 100%;
            height: auto;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Art Gallery</h1>
    <div class="gallery">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="artwork">
                <a href="single-painting.php?ImageID=<?= $row['ImageID'] ?>">
                    <img src="images/<?= $row['Path'] ?>" alt="<?= $row['Title'] ?>">
                    <h3><?= $row['Title'] ?></h3>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php $db->close(); ?>
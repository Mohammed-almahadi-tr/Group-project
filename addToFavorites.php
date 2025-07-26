<?php
session_start();

if (!isset($_GET['ImageID']) || !isset($_GET['Title']) || !isset($_GET['Path'])) {
    header("Location: browse-painting.php");
    exit();
}

// Initialize favorites array if it doesn't exist
if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = array();
}

// Check if this item is already in favorites
$alreadyInFavorites = false;
foreach ($_SESSION['favorites'] as $item) {
    if ($item['ImageID'] == $_GET['ImageID']) {
        $alreadyInFavorites = true;
        break;
    }
}

// Add to favorites if not already there
if (!$alreadyInFavorites) {
    $_SESSION['favorites'][] = array(
        'ImageID' => $_GET['ImageID'],
        'Title' => $_GET['Title'],
        'Path' => $_GET['Path']
    );
}

header("Location: view-favorites.php");
exit();
?>
<?php
session_start();

if (isset($_GET['clear']) && $_GET['clear'] == 1) {
    // Clear all favorites
    $_SESSION['favorites'] = array();
} elseif (isset($_GET['ImageID'])) {
    // Remove specific item from favorites
    if (isset($_SESSION['favorites'])) {
        foreach ($_SESSION['favorites'] as $key => $item) {
            if ($item['ImageID'] == $_GET['ImageID']) {
                unset($_SESSION['favorites'][$key]);
                // Re-index the array to prevent issues
                $_SESSION['favorites'] = array_values($_SESSION['favorites']);
                break;
            }
        }
    }
}

header("Location: view-favorites.php");
exit();
?>
<?php
// Simulate a simple gacha pull
function pullGacha() {
    $items = [
        ['name' => 'Item A', 'rarity' => 'Common'],
        ['name' => 'Item B', 'rarity' => 'Rare'],
        ['name' => 'Item C', 'rarity' => 'Epic'],
        ['name' => 'Item D', 'rarity' => 'Legendary'],
    ];

    // Randomly select an item from the list
    $randomIndex = array_rand($items);
    $selectedItem = $items[$randomIndex];

    $result = [
        'message' => 'Congratulations! You pulled an item from the gacha!',
        'item' => $selectedItem,
    ];

    return $result;
}

header('Content-Type: application/json');

// Handle the gacha pull request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = pullGacha();
    echo json_encode($result);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
}
?>

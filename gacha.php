<?php
// Simulate a simple gacha pull
function pullGacha() {
    $items = [
        ['name' => 'Billing 3 Jam', 'probability' => 0.01],
        ['name' => 'Biling 2 Jam', 'probability' => 0.01],
        ['name' => 'Billing 1 jam', 'probability' => 0.1],
        ['name' => 'Snack', 'probability' => 0.1]
    ];

    $totalProbabilityNonZonk = 0;
    foreach ($items as $nonZonk) {
        $probabilityNonZonk = $nonZonk['probability'];
        $totalProbabilityNonZonk = $totalProbabilityNonZonk + $probabilityNonZonk;
    }
    $probabilityZonk = 1 - $totalProbabilityNonZonk;
    $zonk = [
        ['name' => 'Zonk', 'probability' => $probabilityZonk],
    ];
    $itemsAll = array_merge($items,$zonk);

    // Randomly select an item from the list
    $item = drawItem($itemsAll);
    $selectedItem = $item;

    $result = [
        'message' => 'Congratulations! You pulled an item from the gacha!',
        'item' => $selectedItem,
    ];
    return $result;
   
}



function drawItem($items) {
    $rand = mt_rand() / mt_getrandmax(); // Generate a random number between 0 and 1
    
    $cumulativeProbability = 0;
    foreach ($items as $item) {
        $cumulativeProbability += $item['probability'];
        if ($rand <= $cumulativeProbability) {
            return $item;
        }
    }
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

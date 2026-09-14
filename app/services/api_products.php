<?php
require_once __DIR__ . '/../config/config.php';

header('Content-Type: application/json');

$response = [
    'status' => 'success',
    'data' => [],
    'has_more' => false
];

try {
    $where_clauses = ["1=1"];
    $types = "";
    $params = [];

    // Search
    if (!empty($_GET['search'])) {
        $where_clauses[] = "name LIKE ?";
        $types .= "s";
        $params[] = "%" . $_GET['search'] . "%";
    }

    // Categories (Olfactory Family)
    if (!empty($_GET['category']) && is_array($_GET['category'])) {
        $cat_placeholders = implode(',', array_fill(0, count($_GET['category']), '?'));
        $where_clauses[] = "category IN ($cat_placeholders)";
        $types .= str_repeat("s", count($_GET['category']));
        foreach ($_GET['category'] as $cat) {
            $params[] = $cat;
        }
    }

    // Volumes
    if (!empty($_GET['volume']) && is_array($_GET['volume'])) {
        $vol_placeholders = implode(',', array_fill(0, count($_GET['volume']), '?'));
        $where_clauses[] = "volume IN ($vol_placeholders)";
        $types .= str_repeat("s", count($_GET['volume']));
        foreach ($_GET['volume'] as $vol) {
            $params[] = $vol;
        }
    }

    // Marketing Labels (Collections)
    if (!empty($_GET['marketing_label'])) {
        $labels_array = explode(',', $_GET['marketing_label']);
        $lbl_placeholders = implode(',', array_fill(0, count($labels_array), '?'));
        $where_clauses[] = "label IN ($lbl_placeholders)";
        $types .= str_repeat("s", count($labels_array));
        foreach ($labels_array as $lbl) {
            $params[] = $lbl;
        }
    }

    // Availability
    if (!empty($_GET['availability']) && $_GET['availability'] !== 'all') {
        if ($_GET['availability'] === 'in_stock') {
            $where_clauses[] = "stock > 0 AND (label IS NULL OR label != 'PRE-ORDER')";
        } elseif ($_GET['availability'] === 'pre_order') {
            $where_clauses[] = "label = 'PRE-ORDER'";
        }
    }

    // Price
    if (!empty($_GET['price']) && $_GET['price'] !== 'all') {
        $price = $_GET['price'];
        if ($price === 'under_100') {
            $where_clauses[] = "price < 100";
        } elseif ($price === '100_200') {
            $where_clauses[] = "price >= 100 AND price <= 200";
        } elseif ($price === 'above_200') {
            $where_clauses[] = "price > 200";
        }
    }

    $where_sql = implode(' AND ', $where_clauses);

    // Sorting
    $order_sql = "ORDER BY created_at DESC";
    if (!empty($_GET['sort'])) {
        switch ($_GET['sort']) {
            case 'price_asc':
                $order_sql = "ORDER BY price ASC";
                break;
            case 'price_desc':
                $order_sql = "ORDER BY price DESC";
                break;
            case 'newest':
                $order_sql = "ORDER BY created_at DESC";
                break;
        }
    }

    // Pagination logic
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 6;
    if (!in_array($limit, [6, 12, 24, 50])) $limit = 6;
    $offset = ($page - 1) * $limit;

    // Get Total Count for Pagination UI
    $count_query = "SELECT COUNT(*) as total FROM products WHERE $where_sql";
    $count_stmt = $db->prepare($count_query);
    if (!empty($params)) {
        $count_stmt->bind_param($types, ...$params);
    }
    $count_stmt->execute();
    $total_items = $count_stmt->get_result()->fetch_assoc()['total'];
    $response['total_pages'] = ceil($total_items / $limit);
    $response['current_page'] = $page;
    $response['total_items'] = $total_items;
    $response['limit'] = $limit;

    // Main Query
    $query = "SELECT * FROM products WHERE $where_sql $order_sql LIMIT ? OFFSET ?";
    $types .= "ii";
    $params[] = $limit;
    $params[] = $offset;

    $stmt = $db->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $row['formatted_price'] = formatPrice($row['price']);
        $response['data'][] = $row;
    }

    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
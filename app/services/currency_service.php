<?php
// --- DYNAMIC CURRENCY CONVERSION SERVICE ---
// Handles the business logic of calling the external API and caching in the DB.

$active_currency = isset($_SESSION['user_currency_code']) ? $_SESSION['user_currency_code'] : 'EUR';
$exchange_rate = 1.0;
$currency_symbol = '€';

if ($active_currency !== 'EUR') {
    // Requires $db connection to be available from config.php
    /** @var mysqli $db */
    $stmt = $db->prepare("SELECT exchange_rate, currency_symbol, rate_last_updated FROM shipping_countries WHERE currency_code = ? LIMIT 1");
    $stmt->bind_param("s", $active_currency);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        $exchange_rate = (float)$row['exchange_rate'];
        $currency_symbol = $row['currency_symbol'];
        $last_updated = $row['rate_last_updated'];

        $is_stale = true;
        if ($last_updated) {
            $updated_time = strtotime($last_updated);
            if ((time() - $updated_time) < (12 * 3600)) {
                $is_stale = false;
            }
        }

        if ($is_stale) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, EXCHANGE_RATE_API_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $response = curl_exec($ch);
            
            if ($response) {
                $data = json_decode($response, true);
                if (isset($data['rates'][$active_currency])) {
                    $new_rate = (float)$data['rates'][$active_currency];
                    $exchange_rate = $new_rate;

                    /** @var mysqli $db */
                    $update_stmt = $db->prepare("UPDATE shipping_countries SET exchange_rate = ?, rate_last_updated = NOW() WHERE currency_code = ?");
                    $update_stmt->bind_param("ds", $new_rate, $active_currency);
                    $update_stmt->execute();
                }
            }
        }
    }
}

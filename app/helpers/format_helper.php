<?php
// --- FORMATTING HELPER ---
// Handles reusable view/UI formatting functions.

function formatPrice(float $base_price_eur): string
{
    global $exchange_rate, $currency_symbol;
    $converted = $base_price_eur * $exchange_rate;

    if ($currency_symbol === 'Rp' || $currency_symbol === 'RM' || $currency_symbol === '₱' || $currency_symbol === '¥' || $currency_symbol === '₩') {
        return $currency_symbol . ' ' . number_format($converted, 0, ',', '.');
    } else if ($currency_symbol === '€') {
        return $currency_symbol . ' ' . number_format($converted, 2, ',', ' ');
    } else {
        return $currency_symbol . ' ' . number_format($converted, 2, '.', ',');
    }
}

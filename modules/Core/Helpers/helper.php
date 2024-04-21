<?php

function totalPriceCart($carry, $cart){ 
    $carry += $cart->quantity * $cart->price;
    return $carry;
}

function getPriceCart($carts, $thousands_separator = ","){
    if(!sizeof($carts)){
        return 0;
    }
    $totalPrice = array_reduce($carts, "totalPriceCart");
    return formatCurrency($totalPrice, $thousands_separator);
}

function formatCurrency($price, $thousands_separator = ","){
    return number_format($price, 0, ' ', $thousands_separator);
}

function renderOrderCode($type = "DBH"){
    $date = now()->format("ymdhi");
    $ramdom = rand(100, 999);
    return "$type-$date$ramdom";
}

function renderVariationValue($variation){
    $sizeVariation = sizeof($variation);
    if($sizeVariation){
        $string = "";
        for ($i = $sizeVariation - 1; $i >= 0; $i--){
            $string .= $variation[$i]->value;
            if($i != 0){
                $string .= ", ";
            }
        }
        return "( $string )";
    }
    return "";
}
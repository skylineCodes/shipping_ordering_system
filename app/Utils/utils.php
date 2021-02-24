<?php

namespace App\Utils;

class Utils
{
    protected $shipping;

    protected $custom_tax;

    public function shipping_cost($transport_mode, $item_cost_per_kilo, $per_country_cost)
    {        
        // Calculate shipping cost
        $this->shipping = $transport_mode + $item_cost_per_kilo + $per_country_cost;

        return $this->shipping;
    }

    public function custom_tax($shipping_cost, $percentage = 10)
    {
        // Calculate custom tax
        $this->custom_tax = $shipping_cost / $percentage;

        return $this->custom_tax;
    }

    public function total()
    {
        return $this->shipping + $this->custom_tax;
    }
}
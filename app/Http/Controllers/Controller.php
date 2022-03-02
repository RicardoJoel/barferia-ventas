<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function inArray($id, $array) {
        foreach ($array as $item) {
            if ((int)$id == (int)$item['id'])
                return true;
        }
        return false;
    }

    protected function sort(&$array, $field) {
        usort($array, function($a, $b) use ($field) {
            return strcmp($a[$field], $b[$field]);
        });
    }

    protected function inventory($products, $details) {
        $inventory = [];
        foreach ($products as $product) {
            if ($details) {
                $prod_id = $product->id;
                $det = $details->filter(function($item) use ($prod_id) {
                    return $item->product_id == $prod_id;
                })->first();
            }
            $inventory[$product->id] = [
                'product' => $product->name,
                'stock' => $det->finalstock ?? 0,
            ];
        }
        return $inventory;
    }
}

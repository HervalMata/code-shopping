<?php

namespace CodeShopping\Providers;

use CodeShopping\Models\ProductInput;
use CodeShopping\Models\ProductOutput;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Schema::defaultStringLength(191);
        ProductInput::created(function ($input) {
            $product = $input->product;
            $product->stock += $input->amount;
            $product->save();
        });
        ProductOutput::created(function ($output) {
            $product = $output->product;
            $product->stock -= $output->amount;
            if ($product->stock < 0) {
                throw new \Exception("Estoque de {$product->name} não pode ser negativo.");
            }
            $product->save();
        });
    }

    public function register()
    {
        //
    }
}

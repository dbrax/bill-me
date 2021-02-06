<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github: https://github.com/dbrax/bill-me
 * Email: epmnzava@gmail.com
 * 
 */

namespace Epmnzava\BillMe;

use Illuminate\Support\ServiceProvider;

class BillMeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'bill-me');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'bill-me');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'billme');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('bill-me.php'),
            ], 'config');


            //publishing migrations here..
            if (!class_exists('CreateOrdersTable') && !class_exists('CreateOrderItemsTable') && !class_exists('CreateInvoicesTable') && !class_exists('CreatePaymentMethodTable') && !class_exists('CreatePaymentsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_orders_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_orders_table.php'),
                    __DIR__ . '/../database/migrations/create_order_items_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_order_items_table.php'),
                    __DIR__ . '/../database/migrations/create_invoices_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_invoices_table.php'),
                    __DIR__ . '/../database/migrations/create_payment_method_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_payment_method_table.php'),
                    __DIR__ . '/../database/migrations/create_payments_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_payments_table.php'),

                ], 'migrations');
            }




            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/bill-me'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/bill-me'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/bill-me'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'bill-me');

        // Register the main class to use with the facade
        $this->app->singleton('bill-me', function () {
            return new BillMe;
        });
    }
}

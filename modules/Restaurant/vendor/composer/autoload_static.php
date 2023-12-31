<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9a9cc44af451b52746ddaad6e2d23a27
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Restaurant\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Restaurant\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Modules\\Restaurant\\Database\\Seeders\\RestaurantDatabaseSeeder' => __DIR__ . '/../..' . '/Database/Seeders/RestaurantDatabaseSeeder.php',
        'Modules\\Restaurant\\Events\\OrdenCancelEvent' => __DIR__ . '/../..' . '/Events/OrdenCancelEvent.php',
        'Modules\\Restaurant\\Events\\OrdenEvent' => __DIR__ . '/../..' . '/Events/OrdenEvent.php',
        'Modules\\Restaurant\\Events\\OrdenPaidEvent' => __DIR__ . '/../..' . '/Events/OrdenPaidEvent.php',
        'Modules\\Restaurant\\Events\\OrdenReadyEvent' => __DIR__ . '/../..' . '/Events/OrdenReadyEvent.php',
        'Modules\\Restaurant\\Http\\Controllers\\AreaController' => __DIR__ . '/../..' . '/Http/Controllers/AreaController.php',
        'Modules\\Restaurant\\Http\\Controllers\\BoxesController' => __DIR__ . '/../..' . '/Http/Controllers/BoxesController.php',
        'Modules\\Restaurant\\Http\\Controllers\\CategoryFoodController' => __DIR__ . '/../..' . '/Http/Controllers/CategoryFoodController.php',
        'Modules\\Restaurant\\Http\\Controllers\\DashboardController' => __DIR__ . '/../..' . '/Http/Controllers/DashboardController.php',
        'Modules\\Restaurant\\Http\\Controllers\\FoodController' => __DIR__ . '/../..' . '/Http/Controllers/FoodController.php',
        'Modules\\Restaurant\\Http\\Controllers\\OrdenController' => __DIR__ . '/../..' . '/Http/Controllers/OrdenController.php',
        'Modules\\Restaurant\\Http\\Controllers\\OrdenItemController' => __DIR__ . '/../..' . '/Http/Controllers/OrdenItemController.php',
        'Modules\\Restaurant\\Http\\Controllers\\PosController' => __DIR__ . '/../..' . '/Http/Controllers/PosController.php',
        'Modules\\Restaurant\\Http\\Controllers\\RestaurantController' => __DIR__ . '/../..' . '/Http/Controllers/RestaurantController.php',
        'Modules\\Restaurant\\Http\\Controllers\\StatusOrdenController' => __DIR__ . '/../..' . '/Http/Controllers/StatusOrdenController.php',
        'Modules\\Restaurant\\Http\\Controllers\\StatusTableController' => __DIR__ . '/../..' . '/Http/Controllers/StatusTableController.php',
        'Modules\\Restaurant\\Http\\Controllers\\TableController' => __DIR__ . '/../..' . '/Http/Controllers/TableController.php',
        'Modules\\Restaurant\\Http\\Controllers\\WorkerController' => __DIR__ . '/../..' . '/Http/Controllers/WorkerController.php',
        'Modules\\Restaurant\\Http\\Controllers\\WorkersTypeController' => __DIR__ . '/../..' . '/Http/Controllers/WorkersTypeController.php',
        'Modules\\Restaurant\\Http\\Requests\\AreaRequest' => __DIR__ . '/../..' . '/Http/Requests/AreaRequest.php',
        'Modules\\Restaurant\\Http\\Requests\\CategoryFoodRequest' => __DIR__ . '/../..' . '/Http/Requests/CategoryFoodRequest.php',
        'Modules\\Restaurant\\Http\\Requests\\FoodRequest' => __DIR__ . '/../..' . '/Http/Requests/FoodRequest.php',
        'Modules\\Restaurant\\Http\\Requests\\OrdenItemRequest' => __DIR__ . '/../..' . '/Http/Requests/OrdenItemRequest.php',
        'Modules\\Restaurant\\Http\\Requests\\OrdenRequest' => __DIR__ . '/../..' . '/Http/Requests/OrdenRequest.php',
        'Modules\\Restaurant\\Http\\Requests\\StatusOrdenRequest' => __DIR__ . '/../..' . '/Http/Requests/StatusOrdenRequest.php',
        'Modules\\Restaurant\\Http\\Requests\\StatusTableRequest' => __DIR__ . '/../..' . '/Http/Requests/StatusTableRequest.php',
        'Modules\\Restaurant\\Http\\Requests\\TableRequest' => __DIR__ . '/../..' . '/Http/Requests/TableRequest.php',
        'Modules\\Restaurant\\Http\\Requests\\WorkerRequest' => __DIR__ . '/../..' . '/Http/Requests/WorkerRequest.php',
        'Modules\\Restaurant\\Http\\Requests\\WorkersTypeRequest' => __DIR__ . '/../..' . '/Http/Requests/WorkersTypeRequest.php',
        'Modules\\Restaurant\\Http\\Resources\\FoodCollection' => __DIR__ . '/../..' . '/Http/Resources/FoodCollection.php',
        'Modules\\Restaurant\\Http\\Resources\\OrdenCollection' => __DIR__ . '/../..' . '/Http/Resources/OrdenCollection.php',
        'Modules\\Restaurant\\Http\\Resources\\OrdenItemCollection' => __DIR__ . '/../..' . '/Http/Resources/OrdenItemCollection.php',
        'Modules\\Restaurant\\Http\\Resources\\TableCollection' => __DIR__ . '/../..' . '/Http/Resources/TableCollection.php',
        'Modules\\Restaurant\\Models\\Area' => __DIR__ . '/../..' . '/Models/Area.php',
        'Modules\\Restaurant\\Models\\CategoryFood' => __DIR__ . '/../..' . '/Models/CategoryFood.php',
        'Modules\\Restaurant\\Models\\Food' => __DIR__ . '/../..' . '/Models/Food.php',
        'Modules\\Restaurant\\Models\\Orden' => __DIR__ . '/../..' . '/Models/Orden.php',
        'Modules\\Restaurant\\Models\\OrdenItem' => __DIR__ . '/../..' . '/Models/OrdenItem.php',
        'Modules\\Restaurant\\Models\\StatusOrden' => __DIR__ . '/../..' . '/Models/StatusOrden.php',
        'Modules\\Restaurant\\Models\\StatusTable' => __DIR__ . '/../..' . '/Models/StatusTable.php',
        'Modules\\Restaurant\\Models\\Table' => __DIR__ . '/../..' . '/Models/Table.php',
        'Modules\\Restaurant\\Models\\WorkersType' => __DIR__ . '/../..' . '/Models/WorkersType.php',
        'Modules\\Restaurant\\Providers\\RestaurantServiceProvider' => __DIR__ . '/../..' . '/Providers/RestaurantServiceProvider.php',
        'Modules\\Restaurant\\Providers\\RouteServiceProvider' => __DIR__ . '/../..' . '/Providers/RouteServiceProvider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9a9cc44af451b52746ddaad6e2d23a27::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9a9cc44af451b52746ddaad6e2d23a27::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9a9cc44af451b52746ddaad6e2d23a27::$classMap;

        }, null, ClassLoader::class);
    }
}

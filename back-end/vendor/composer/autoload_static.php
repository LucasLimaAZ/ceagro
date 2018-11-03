<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7af411bac7756e8562419bf7dd0e78b2
{
    public static $classMap = array (
        'App\\Controllers\\AdendosController' => __DIR__ . '/../..' . '/app/controllers/AdendosController.php',
        'App\\Controllers\\ClientesController' => __DIR__ . '/../..' . '/app/controllers/ClientesController.php',
        'App\\Controllers\\ContatosController' => __DIR__ . '/../..' . '/app/controllers/ContatosController.php',
        'App\\Controllers\\ContratosController' => __DIR__ . '/../..' . '/app/controllers/ContratosController.php',
        'App\\Controllers\\EnderecosController' => __DIR__ . '/../..' . '/app/controllers/EnderecosController.php',
        'App\\Controllers\\ProdutosController' => __DIR__ . '/../..' . '/app/controllers/ProdutosController.php',
        'App\\Core\\AAAAa' => __DIR__ . '/../..' . '/core/teste.php',
        'App\\Core\\App' => __DIR__ . '/../..' . '/core/App.php',
        'App\\Core\\Database\\Conexao' => __DIR__ . '/../..' . '/core/database/Conexao.php',
        'App\\Core\\Database\\QueryBuilder' => __DIR__ . '/../..' . '/core/database/QueryBuilder.php',
        'App\\Core\\Request' => __DIR__ . '/../..' . '/core/Request.php',
        'App\\Core\\Router' => __DIR__ . '/../..' . '/core/Router.php',
        'App\\Models\\Banco' => __DIR__ . '/../..' . '/app/models/Banco.php',
        'App\\Models\\Cliente' => __DIR__ . '/../..' . '/app/models/Cliente.php',
        'App\\Models\\Contrato' => __DIR__ . '/../..' . '/app/models/Contrato.php',
        'App\\Models\\Model' => __DIR__ . '/../..' . '/app/models/Model.php',
        'App\\Models\\Produto' => __DIR__ . '/../..' . '/app/models/Produto.php',
        'ComposerAutoloaderInit7af411bac7756e8562419bf7dd0e78b2' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit7af411bac7756e8562419bf7dd0e78b2' => __DIR__ . '/..' . '/composer/autoload_static.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit7af411bac7756e8562419bf7dd0e78b2::$classMap;

        }, null, ClassLoader::class);
    }
}

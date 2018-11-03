<?php

namespace App\Core;

class Router
{
    protected $routes = [
        'POST' => [],
        'GET' => [],
    ];

    public static function carregar($arquivo)
    {
        $router = new self;
        require $arquivo;
        return $router;
    }

    public function post($rota, $controller)
    {
        $this->routes['POST'][$rota] = $controller;
    }

    public function get($rota, $controller)
    {
        $this->routes['GET'][$rota] = $controller;
    }

    public function direcionar($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            try {
                return $this->executarAcao(
                    ...explode('@', $this->routes[$requestType][$uri])
                );
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        } else {
            foreach ($this->routes[$requestType] as $key => $val) {
                $pattern = preg_replace('#\(/\)#', '/?', $key);
                $pattern = "@^" . preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern) . "$@D";
                preg_match($pattern, $uri, $matches);
                array_shift($matches);
                if ($matches) {
                    $getAction = explode('@', $val);
                    return $this->executarAcao($getAction[0], $getAction[1], $matches);
                }
            }

        }
        throw new \Exception('Rota inválida');

    }

    protected function executarAcao($controller, $metodo, $parametros = [])
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;
        if (!method_exists($controller, $metodo)) {
            throw new \Exception(
                "Método não encontrado"
            );
        }

        return $controller->$metodo($parametros);
    }

}

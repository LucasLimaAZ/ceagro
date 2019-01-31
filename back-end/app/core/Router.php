<?php

namespace App\Core;

class Router
{
    protected $routes = [
        'POST' => [],
        'PUT' => [],
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

    public function put($rota, $controller)
    {
        $this->routes['PUT'][$rota] = $controller;
    }

    public function delete($rota, $controller)
    {
        $this->routes['DELETE'][$rota] = $controller;
    }

    public function get($rota, $controller)
    {
        $this->routes['GET'][$rota] = $controller;
    }

    public function direcionar($uri, $requestType)
    {
        if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE')) {
            parse_str(file_get_contents('php://input'), $_DELETE);
        }
        if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT')) {
            parse_str(file_get_contents('php://input'), $putData);
        }

        if (array_key_exists($uri, $this->routes[$requestType])) {
            try {
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    list($controller, $metodo) = explode('@', $this->routes[$requestType][$uri]);
                    return $this->executarAcao(
                        $controller,
                        $metodo,
                        $_POST
                    );

                }
                if (sizeof($_GET) > 1) {

                    list($controller, $metodo) = explode('@', $this->routes[$requestType][$uri]);
                    return $this->executarAcao(
                        $controller,
                        $metodo,
                        array_slice($_GET, 1)
                    );
                }
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
                    $parametros = (isset($putData)) ? $putData : $parametros = [];
                    foreach ($matches as $key => $match) {
                        if (preg_match('/[^0-9]/', $key)) {
                            $parametros[$key] = $match;
                        }
                    }
                    return $this->executarAcao($getAction[0], $getAction[1], $parametros);
                }
            }

        }
        http_response_code(400);
        throw new \Exception('Rota inválida');

    }

    protected function executarAcao($controller, $metodo, $parametros = [])
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;
        if (!method_exists($controller, $metodo)) {
            throw new \Exception("Método não encontrado");
        }

        if ($this->isPost() || $this->isPut()) {
            return $controller->$metodo($parametros);
        }

        $parametros = array_values($parametros);
        return $controller->$metodo(...$parametros);
    }

    private function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        }
        return false;
    }

    private function isPut()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            return true;
        }
        return false;
    }

    private function isGet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return true;
        }
        return false;
    }

}

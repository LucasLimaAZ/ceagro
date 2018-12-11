<?php

namespace App\Models;

use App\Core\App;

class Model
{

    public static function get($where = null)
    {
        return App::get("db")->selectAll(static::$table, static::class, $where);
    }

    public static function find($campos = ["id", 0])
    {
        $response = App::get('db')->find(
            static::$table, 
            $campos, 
            static::class
        );
        return $a = array_shift($response);
    }

    public static function contratosFuturos()
    {
        return $response = App::get('db')->contratosFuturos();
    }

    public static function delete($campos = ["id", 0])
    {
        $response = App::get('db')->delete(static::$table, $campos);
        return "deletado com sucesso";
    }

    public static function store($dados)
    {
        $data = self::verifyFields($dados);
        return App::get('db')->insert(static::$table, $data);
    }

    private static function verifyFields($data)
    {
        $reflection = new \ReflectionClass(static::class);
        $instance = (array) $reflection->newInstanceWithoutConstructor();
        foreach ($instance as $instanceKey => $field) {
            foreach ($data as $dataKey => $value) {
                if(!array_key_exists($dataKey, $instance)) {
                    unset($data[$dataKey]);
                }
            }
        }
        return $data;
    }

    public static function update($dados, $campos = [])
    {
        $data = self::verifyFields($dados);
        return App::get('db')->update(static::$table, $data, $campos);
    }
}

<?php

namespace App\Core\Database;

use \PDO;

class QueryBuilder
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($tabela, $classe, $where = null)
    {
        $query = "select * from {$tabela}";
        if (is_array($where) && count($where) === 3) {
            ($where) ? $query .= " where " . implode(" ", $where) : '';

        } else {
            ($where) ? $query .= " where " . implode(" = ", $where) : '';
        }
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS, $classe);
        } catch (\PDOException $e) {
            die($e);
        }
    }

    public function select($query)
    {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetch();

        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function selectWhere($tabela, $campos = null)
    {
        $query = "select * from {$tabela}";
        $query .= ($campos) ? " where " . implode(' = ', $campos) : "";
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public function selectTo($tabela, $classe, $campos = null, $limite = null)
    {
        $query = "select * from {$tabela}";
        $query .= ($campos) ? " where " . implode(' > ', $campos) : "";
        $query .= " order by id desc";
        $query .= ($limite) ? " limit {$limite}" : "";
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS, $classe);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public function find($tabela, $campos, $classe)
    {
        $campos = implode(' = ', $campos);
        $query = "select * from {$tabela} where {$campos}";
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            $campos = null;
            return $statement->fetchAll(PDO::FETCH_CLASS, $classe);
        } catch (PDOException $exception) {
            http_response_code(500);
            die($exception);
        }
    }

    public function contratosFuturos()
    {
        $query = "select count(*) as futuros from contratos where futuro = 1";
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_LAZY);
        } catch (PDOException $exception) {
            http_response_code(500);
            die($exception);
        }
    }

    public function contratosAtuais()
    {
        $query = "select count(*) as atuais from contratos where futuro != 1";

        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_LAZY);
        } catch (PDOException $exception) {
            http_response_code(500);
            die($exception);
        }
    }

    public function insert($tabela, $dados)
    {
        $dados = (array)$dados;
        $sql = sprintf(
            "INSERT INTO %s(%s) values(%s)",
            $tabela,
            implode(', ', array_keys($dados)),
            ':' . implode(', :', array_keys($dados))
        );
        try {
            $statement = $this->pdo->prepare($sql);
            $e = $statement->execute($dados);
            if (!$e) {
                throw new \Exception('Erro ao inserir');
            }
            return $this->pdo->lastInsertId();

        } catch (\Exception $e) {
            http_response_code(500);
            die($e->getMessage());
        }
    }

    public function update($tabela, $dados, $where)
    {
        $dados = (array)$dados;
        $campos = '';
        foreach ($dados as $key => $valor) {
            $campos .= "\n $key=:$key,";
        }
        $campos = rtrim($campos, ",");
        $sql = sprintf(
            "UPDATE %s \n SET %s \n WHERE %s",
            $tabela,
            $campos,
            implode(" = ", $where)
        );
        try {
            $statement = $this->pdo->prepare($sql)->execute($dados);
            return $where[1];
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();

        }
    }

    public function delete($tabela, $campos)
    {
        $where = implode(' = ', $campos);
        $sql = "DELETE FROM {$tabela} WHERE {$where}";
        try {
            $statement = $this->pdo->prepare($sql)->execute();
            return $statement;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();

        }
    }
}

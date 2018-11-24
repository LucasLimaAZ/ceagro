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
        ($where) ? $query .= " where " . implode(" ", $where) : '';
        $query .= " limit 10;";
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS, $classe);
        } catch (\PDOException $e) {
            die($e->getMessage());
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
        try {
            $campos = implode(' = ', $campos);
            $statement = $this->pdo->prepare("select * from {$tabela} where {$campos}");
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS, $classe);
        } catch (PDOException $exception) {
            die($exception);
        }
    }

    public function insert($tabela, $dados)
    {
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
            return [$e->getMessage(), $sql, $dados];
        }
    }

    public function update($tabela, $dados, $where)
    {
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

    public function delete($tabela, $campos = [])
    {
        $campos = implode(' = ', $campos);
        $sql = "DELETE FROM {$tabela} WHERE {$campos}";
        try {
            $statement = $this->pdo->prepare($sql)->execute();
            return $statement;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();

        }
    }
}

<?php

namespace TutorialMvc\Model;

use PDO;

class Product
{
    private $conn;
    private $log;

    public function __construct(PDO $conn, $l)
    {
        $this->conn = $conn;
        $this->log = $l;
    }

    public function fetch()
    {
        $stm = $this->conn->query('select * from products');
        $this->log->info('Executando a função Fetch pela instância da classe Product');

        if ($stm) {
            return $stm->fetchAll();
        }

        return [];
    }

    public function find($id)
    {
        $stm = $this->conn->prepare('select * from products where id=?');
        $this->log->info('Executando a função Create com o Produto ' . $name . ' pela instância da classe Product');
        
        if ($stm->execute([$id])) {
            $product = $stm->fetch();
            if ($product) {
                return $product;
            }
        }

        return [];
    }

    public function create($name)
    {
        $stm = $this->conn->prepare('insert into products(name) value(?)');
        $this->log->info('Executando a função Find com o Id ' . $args['id'] . ' pela instância da classe Product');
        if($stm->execute([$name])) {
            return $this->find($this->conn->lastInsertId());
        }

        return [];
    }

    public function update($id, $name)
    {
        $stm = $this->conn->prepare('update products set name=? where id=?');
        $this->log->info('Executando a função Update no Id ' . $args['id'] . ' pela instância da classe Product');

        if ($stm->execute([$name, $id])) {
            return $this->find($id);
        }

        return [];
    }

    public function delete($id)
    {
        $product = $this->find($id);
        $this->log->info('Executando a função Delete no Id ' . $args['id'] . ' pela instância da classe Product');

        if ($product) {
            $stm = $this->conn->prepare('delete from products where id=?');
            if ($stm->execute([$id])) {
                return $product;
            }
        }

        return [];
    }
}

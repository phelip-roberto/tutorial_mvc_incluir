<?php

namespace TutorialMvc\Controller;

use TutorialMvc\Model\Product;

class ProductController
{
    private $prod;
    private $log;

    public function __construct(Product $p, $l)
    {
        $this->prod = $p;
        $this->log = $l;
    }

    public function fetch($request, $response)
    {
        $this->log->info('Executando a função Fetch pela instância do controller ProductController');
        $data = $this->prod->fetch();
        return $response->withJson($data);
    }

    public function create($request, $response)
    {
        $name = $request->getParam('name');
        $this->log->info('Executando a função Create com o Produto ' . $name . ' pela instância do controller ProductController');
        $product = $this->prod->create($name);
        return $response->withJson($product);
    }

    public function find($request, $response, $args)
    {
        $this->log->info('Executando a função Find com o Id ' . $args['id'] . ' pela instância do controller ProductController');
        $product = $this->prod->find($args['id']);
        return $response->withJson($product);
    }

    public function update($request, $response, $args)
    {
        $this->log->info('Executando a função Update no Id ' . $args['id'] . ' pela instância do controller ProductController');
        $name = $request->getParam('name');
        $product = $this->prod->update($args['id'], $name);
        return $response->withJson($product);
    }

    public function delete($request, $response, $args)
    {
        $this->log->info('Executando a função Delete no Id ' . $args['id'] . ' pela instância do controller ProductController');
        $product = $this->prod->delete($args['id']);
        return $response->withJson($product);
    }
}

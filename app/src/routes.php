<?php

// GET /produtos: retorna uma lista de produtos no formato json
$router->get('/produtos', 'TutorialMvc\Controller\ProductController:fetch');
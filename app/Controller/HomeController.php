<?php

class HomeController {

    public function index() 
    {
        try {

            $colecItens = Postagem::selecionaTodos();

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $parametros = array();
            $parametros['itens'] = $colecItens;

            $conteudo = $template->render($parametros);
            echo $conteudo;

        } catch (Exception $e) {

            echo $e->getMessage();
            
        }
    }

}
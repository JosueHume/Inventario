<?php

class PostController {

    public function index($params) 
    {
        try {

            $item = Postagem::selecionarPorId($params);

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('item.html');

            $parametros = array();
            $parametros['nome'] = $item->nome;
            $parametros['tipo'] = $item->tipo;
            $parametros['aquisicao'] = $item->aquisicao;
            $parametros['descricao'] = $item->descricao;

            $conteudo = $template->render($parametros);
            echo $conteudo;

        } catch (Exception $e) {
            echo $e->getMessage();   
        }
    }
}
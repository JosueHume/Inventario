<?php

class AdminController {

    public function index() 
    {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $objItens = Postagem::selecionaTodos();

            $parametros = array();
            $parametros['itens'] = $objItens;

            $conteudo = $template->render($parametros);
            echo $conteudo;      
    }

    public function relatorio() 
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('relatorio.html');

        $objItens = Postagem::selecionaTodos();

        $parametros = array();
        $parametros['itens'] = $objItens;

        $conteudo = $template->render($parametros);
        echo $conteudo; 
    }

    public function create() 
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $parametros = array();

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }


    // Pega a função insert da classe Postagem
    public function insert() 
    {
        try {
            Postagem::insert($_POST);
        } catch (Exception $e) {
            echo '<script> alert("Falha o cadastrar o item!"); </script>';
            echo '<script> location.href="http://localhost/Inventario/?pagina=admin&=home"; </script>';
        }    
    }

    public function change($paramId) 
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        $post = Postagem::selecionarPorId($paramId);

        $parametros = array();
        $parametros['id'] = $post->id;
        $parametros['nome'] = $post->nome;
        $parametros['tipo'] = $post->tipo;
        $parametros['aquisicao'] = $post->aquisicao;
        $parametros['descricao'] = $post->descricao;

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    // Pega a função update da classe Postagem
    public function update($paramId) 
    {
        try {
            Postagem::update($_POST);

            echo '<script> alert("Item editado com sucesso!"); </script>';
            echo '<script> location.href="http://localhost/Inventario/?pagina=admin&=home"; </script>';

        } catch (Exception $e)  {
            echo '<script> alert("'.$e->getMessage().'"); </script>';
            echo '<script> location.href="http://localhost/Inventario/?pagina=admin&metodo=change"; </script>';
        }
    }

    // Pega a função update da classe Postagem
    public function delete($paramId) 
    {
        try {
            Postagem::delete($id);

            echo '<script> alert("Item deletado com sucesso!"); </script>';
            echo '<script> location.href="http://localhost/Inventario/?pagina=admin&=home"; </script>';

        } catch (Exception $e)  {
            echo '<script> alert("'.$e->getMessage().'"); </script>';
            echo '<script> location.href="http://localhost/Inventario/?pagina=admin&metodo=change"; </script>';
        }
    }

}
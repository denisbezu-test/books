<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;
use \App\Models\Author as AuthorModel;

class Author extends Controller
{
    public function __construct($route_params)
    {
        parent::__construct($route_params);
        $this->redirectHomeIfNotLogged();
    }
///afficher la liste
    public function listAction($args = [])
    {
        $args = array_merge($args, [
            'authors' => AuthorModel::getAll()
        ]);
        View::renderTemplate('Author/list.html.twig', $args);
    }
///modifier l'affichage
    public function editAction($args = [])
    {
        $idAuthor = $this->getRequestByKey('id');
        if (empty($idAuthor)) {
            $this->redirect('/authors');
        }
        $args = array_merge($args, [
           'author' => new AuthorModel($idAuthor)
        ]);

        View::renderTemplate('Author/edit.html.twig', $args);
    }
///supprimer
    public function deleteAction()
    {
        $idAuthor = $this->getPost('id_author');
        try {
            if (!empty($idAuthor)) {
                $author = new AuthorModel($idAuthor);
                $author->delete();
            }

            $this->redirect('/authors');
        } catch (\Exception $e) {
            return $this->listAction([
                'error' => 'Error while deleting object, object is used somewhere'
            ]);
        }
    }

    public function createAction($args = [])
    {
        View::renderTemplate('Author/create.html.twig', $args);
    }
///enregistrer les modifications
    public function editSubmitAction()
    {
        $id = $this->getPost('id');
        $name = $this->getPost('name');
        $lastname = $this->getPost('lastname');

        if (empty($name) || empty($lastname)) {
            $this->redirect('/authors/edit?id=' . $id);
        }

        $author = new AuthorModel($id);
        $author->setName($name);
        $author->setLastname($lastname);

        $author->save();
        $this->redirect('/authors');
    }


    /**
     * enregistrer la creation
     */
    public function createSubmitAction()
    {
        $name = $this->getPost('name');
        $lastname = $this->getPost('lastname');

        if (empty($name) || empty($lastname)) {
            return $this->createAction([
                'error' => 'Verify your input, some parameters are empty'
            ]);
        }
        $author = new AuthorModel();
        $author->setName($name);
        $author->setLastname($lastname);
        $author->save();

        $this->redirect('/authors');
    }
}
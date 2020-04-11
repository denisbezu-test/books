<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;
use \App\Models\Author as AuthorModel;

class Author extends Controller
{
    public function listAction($args = [])
    {
        $args = array_merge($args, [
            'authors' => AuthorModel::getAll()
        ]);
        View::renderTemplate('Author/list.html.twig', $args);
    }

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

    public function deleteAction()
    {
        $idAuthor = $this->getPost('id_author');
        if (!empty($idAuthor)) {
            $author = new AuthorModel($idAuthor);
            $author->delete();
        }

        $this->redirect('/authors');
    }

    public function createAction($args = [])
    {
        View::renderTemplate('Author/create.html.twig', $args);
    }

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

    public function createSubmitAction()
    {
        $name = $this->getPost('name');
        $lastname = $this->getPost('lastname');

        if (empty($name) || empty($lastname)) {
            return $this->createAction([
                'error' => 'Verify you input, some parameters are empty'
            ]);
        }
        $author = new AuthorModel();
        $author->setName($name);
        $author->setLastname($lastname);
        $author->save();

        $this->redirect('/authors');
    }
}
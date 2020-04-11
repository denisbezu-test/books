<?php


namespace App\Controllers;

use Core\Controller;
use App\Models\Genre as GenreModel;
use Core\View;

class Genre extends Controller
{
    public function listAction($args = [])
    {
        $args = array_merge($args, [
            'genres' => GenreModel::getAll()
        ]);
        View::renderTemplate('Genre/list.html.twig', $args);
    }

    public function editAction($args = [])
    {
        $idGenre = $this->getRequestByKey('id');
        if (empty($idGenre)) {
            $this->redirect('/genres');
        }
        $args = array_merge($args, [
            'genre' => new GenreModel($idGenre)
        ]);

        View::renderTemplate('Genre/edit.html.twig', $args);
    }

    public function deleteAction()
    {
        $idGenre = $this->getPost('id_genre');
        if (!empty($idGenre)) {
            $genre = new GenreModel($idGenre);
            $genre->delete();
        }

        $this->redirect('/genres');
    }

    public function createAction($args = [])
    {
        View::renderTemplate('Genre/create.html.twig', $args);
    }

    public function editSubmitAction()
    {
        $id = $this->getPost('id');
        $name = $this->getPost('name');

        if (empty($name)) {
            $this->redirect('/genres/edit?id=' . $id);
        }

        $genre = new GenreModel($id);
        $genre->setName($name);

        $genre->save();
        $this->redirect('/genres');
    }

    public function createSubmitAction()
    {
        $name = $this->getPost('name');

        if (empty($name)) {
            return $this->createAction([
                'error' => 'Verify your input, some parameters are empty'
            ]);
        }
        $genre = new GenreModel();
        $genre->setName($name);
        $genre->save();

        $this->redirect('/genres');
    }
}
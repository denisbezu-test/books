<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Book as BookModel;
use Core\View;

class Book extends Controller
{
    public function listAction($args = [])
    {
        $args = array_merge($args, [
            'books' => BookModel::getDisplayList()
        ]);
        View::renderTemplate('Book/list.html.twig', $args);
    }

    public function editAction($args = [])
    {
        $idBook = $this->getRequestByKey('id');
        if (empty($idBook)) {
            $this->redirect('/books');
        }
        $args = array_merge($args, [
            'book' => new BookModel($idBook),
            'authors' => \App\Models\Author::getAll(),
            'genres' => \App\Models\Genre::getAll(),
            'publishers' => \App\Models\Publisher::getAll()
        ]);

        View::renderTemplate('Book/edit.html.twig', $args);
    }

    public function deleteAction()
    {
        $idBook = $this->getPost('id_book');
        try {
            if (!empty($idBook)) {
                $book = new BookModel($idBook);
                $book->delete();
            }

            $this->redirect('/books');
        } catch (\Exception $e) {
            return $this->listAction([
                'error' => 'Error while deleting object, object is used somewhere'
            ]);
        }
    }

    public function createAction($args = [])
    {
        $args = array_merge($args, [
            'authors' => \App\Models\Author::getAll(),
            'genres' => \App\Models\Genre::getAll(),
            'publishers' => \App\Models\Publisher::getAll()
        ]);
        View::renderTemplate('Book/create.html.twig', $args);
    }

    public function editSubmitAction()
    {
        $id = $this->getPost('id');
        $name = $this->getPost('name');
        $idAuthor = $this->getPost('id_author');
        $idGenre = $this->getPost('id_genre');
        $idPublisher = $this->getPost('id_publisher');
        $year = $this->getPost('year');
        $pages = $this->getPost('pages');
        $quantity = $this->getPost('quantity');

        if (empty($name) || empty($idAuthor) || empty($idGenre) || empty($idPublisher)
            || empty($year) || empty($pages) || empty($quantity)) {
            $this->redirect('/books/edit?id=' . $id);
        }

        $book = new BookModel($id);
        $book->setName($name);
        $book->setIdAuthor($idAuthor);
        $book->setIdGenre($idGenre);
        $book->setIdPublisher($idPublisher);
        $book->setYear($year);
        $book->setPages($pages);
        $book->setQuantity($quantity);
        $book->save();

        $this->redirect('/books');
    }

    public function createSubmitAction()
    {
        $name = $this->getPost('name');
        $idAuthor = $this->getPost('id_author');
        $idGenre = $this->getPost('id_genre');
        $idPublisher = $this->getPost('id_publisher');
        $year = $this->getPost('year');
        $pages = $this->getPost('pages');
        $quantity = $this->getPost('quantity');

        if (empty($name) || empty($idAuthor) || empty($idGenre) || empty($idPublisher)
            || empty($year) || empty($pages) || empty($quantity)) {
            return $this->createAction([
                'error' => 'Verify your input, some parameters are empty'
            ]);
        }
        $book = new BookModel();
        $book->setName($name);
        $book->setIdAuthor($idAuthor);
        $book->setIdGenre($idGenre);
        $book->setIdPublisher($idPublisher);
        $book->setYear($year);
        $book->setPages($pages);
        $book->setQuantity($quantity);
        $book->save();

        $this->redirect('/books');
    }
}
<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Rent as RentModel;
use Core\View;

class Rent extends Controller
{
    public function listAction($args = [])
    {
        $args = array_merge($args, [
            'rents' => RentModel::getDisplayList()
        ]);
        View::renderTemplate('Rent/list.html.twig', $args);
    }

    public function editAction($args = [])
    {
        $idRent = $this->getRequestByKey('id');
        if (empty($idRent)) {
            $this->redirect('/rents');
        }
        $args = array_merge($args, [
            'rent' => new RentModel($idRent),
            'books' => \App\Models\Book::getAll(),
            'readers' => \App\Models\Reader::getAll()
        ]);

        View::renderTemplate('Rent/edit.html.twig', $args);
    }

    public function deleteAction()
    {
        $idRent = $this->getPost('id_rent');
        try {
            if (!empty($idRent)) {
                $rent = new RentModel($idRent);
                if (!$rent->getIsReturned()) {
                    $book = new \App\Models\Book($rent->getIdBook());
                    $book->setQuantity($book->getQuantity() + 1);
                    $book->save();
                }
                $rent->delete();
            }

            $this->redirect('/rents');
        } catch (\Exception $e) {
            return $this->listAction([
                'error' => 'Error while deleting object, object is used somewhere'
            ]);
        }
    }

    public function returnAction()
    {
        $idRent = $this->getPost('id_rent');
        if (!empty($idRent)) {
            $rent = new RentModel($idRent);
            $rent->setIsReturned(1);
            $rent->save();
            $book = new \App\Models\Book($rent->getIdBook());
            $book->setQuantity($book->getQuantity() + 1);
            $book->save();
        }

        $this->redirect('/rents');
    }

    public function createAction($args = [])
    {
        $args = array_merge($args, [
            'books' => \App\Models\Book::getBooksForRent(),
            'readers' => \App\Models\Reader::getAll()
        ]);

        View::renderTemplate('Rent/create.html.twig', $args);
    }

    public function editSubmitAction()
    {
        $id = $this->getPost('id');
        $idBook = $this->getPost('id_book');
        $idReader = $this->getPost('id_reader');
        $dateRent = $this->getPost('date_rent');
        $isReturned = $this->getPost('is_returned');

        if (empty($idBook) || empty($idReader) || empty($dateRent)) {
            $this->redirect('/rents/edit?id=' . $id);
        }

        $rent = new RentModel($id);
        $oldReturned = $rent->getIsReturned();
        $rent->setIdBook($idBook);
        $rent->setIdReader($idReader);
        $rent->setDateRent($dateRent);
        $rent->setIsReturned((int)$isReturned);
        $book = new \App\Models\Book($idBook);
        if ($isReturned == true && $oldReturned == false) {
            $book->setQuantity($book->getQuantity() + 1);
            $book->save();
        } else if ($isReturned == false && $oldReturned == true) {
            if ($book->getQuantity() > 0) {
                $book->setQuantity($book->getQuantity() - 1);
                $book->save();
            } else {
                return $this->listAction([
                    'error' => 'You cannot rent this book, quantity is 0'
                ]);
            }
        }
        $rent->save();
        $this->redirect('/rents');
    }

    public function createSubmitAction()
    {
        $idBook = $this->getPost('id_book');
        $idReader = $this->getPost('id_reader');
        $dateRent = $this->getPost('date_rent');

        if (empty($idBook) || empty($idReader) || empty($dateRent)) {
            return $this->createAction([
                'error' => 'Verify your input, some parameters are empty'
            ]);
        }

        $rent = new RentModel();
        $rent->setIdBook($idBook);
        $rent->setIdReader($idReader);
        $rent->setDateRent($dateRent);
        $rent->setIsReturned(0);
        $rent->save();

        //rent book
        $book = new \App\Models\Book($idBook);
        $book->setQuantity($book->getQuantity() - 1);
        $book->save();

        $this->redirect('/rents');
    }
}
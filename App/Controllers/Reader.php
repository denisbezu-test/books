<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Reader as ReaderModel;
use Core\View;

class Reader extends Controller
{
    public function listAction($args = [])
    {
        $args = array_merge($args, [
            'readers' => ReaderModel::getAll()
        ]);

        View::renderTemplate('Reader/list.html.twig', $args);
    }

    public function editAction($args = [])
    {
        $idReader = $this->getRequestByKey('id');
        if (empty($idReader)) {
            $this->redirect('/readers');
        }
        $args = array_merge($args, [
            'reader' => new ReaderModel($idReader)
        ]);

        View::renderTemplate('Reader/edit.html.twig', $args);
    }

    public function deleteAction()
    {
        $idReader = $this->getPost('id_reader');
        try {
            if (!empty($idReader)) {
                $reader = new ReaderModel($idReader);
                $reader->delete();
            }

            $this->redirect('/readers');
        } catch (\Exception $e) {
            return $this->listAction([
                'error' => 'Error while deleting object, object is used somewhere'
            ]);
        }
    }

    public function createAction($args = [])
    {
        View::renderTemplate('Reader/create.html.twig', $args);
    }

    public function editSubmitAction()
    {
        $id = $this->getPost('id');
        $name = $this->getPost('name');
        $lastname = $this->getPost('lastname');
        $birthdate = $this->getPost('birthdate');
        $phone = $this->getPost('phone');

        if (empty($name) || empty($lastname) || empty($birthdate) || empty($phone)) {
            $this->redirect('/readers/edit?id=' . $id);
        }

        $reader = new ReaderModel($id);
        $reader->setName($name);
        $reader->setLastname($lastname);
        $reader->setBirthdate($birthdate);
        $reader->setPhone($phone);
        $reader->save();

        $this->redirect('/readers');
    }

    public function createSubmitAction()
    {
        $name = $this->getPost('name');
        $lastname = $this->getPost('lastname');
        $birthdate = $this->getPost('birthdate');
        $phone = $this->getPost('phone');

        if (empty($name) || empty($lastname) || empty($birthdate) || empty($phone)) {
            return $this->createAction([
                'error' => 'Verify your input, some parameters are empty'
            ]);
        }
        $reader = new ReaderModel();
        $reader->setName($name);
        $reader->setLastname($lastname);
        $reader->setBirthdate($birthdate);
        $reader->setPhone($phone);
        $reader->save();

        $this->redirect('/readers');
    }
}
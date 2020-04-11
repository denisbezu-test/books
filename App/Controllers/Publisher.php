<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Publisher as PublisherModel;
use Core\View;

class Publisher extends Controller
{
    public function listAction($args = [])
    {
        $args = array_merge($args, [
            'publishers' => PublisherModel::getAll()
        ]);

        View::renderTemplate('Publisher/list.html.twig', $args);
    }

    public function editAction($args = [])
    {
        $idPublisher = $this->getRequestByKey('id');
        if (empty($idPublisher)) {
            $this->redirect('/publishers');
        }
        $args = array_merge($args, [
            'publisher' => new PublisherModel($idPublisher)
        ]);

        View::renderTemplate('Publisher/edit.html.twig', $args);
    }

    public function deleteAction()
    {
        $idPublisher = $this->getPost('id_publisher');
        if (!empty($idPublisher)) {
            $publisher = new PublisherModel($idPublisher);
            $publisher->delete();
        }

        $this->redirect('/publishers');
    }

    public function createAction($args = [])
    {
        View::renderTemplate('Publisher/create.html.twig', $args);
    }

    public function editSubmitAction()
    {
        $id = $this->getPost('id');
        $name = $this->getPost('name');
        $dimension = $this->getPost('dimension');

        if (empty($name) || empty($dimension)) {
            $this->redirect('/publishers/edit?id=' . $id);
        }

        $publisher = new PublisherModel($id);
        $publisher->setName($name);
        $publisher->setDimension($dimension);
        $publisher->save();

        $this->redirect('/publishers');
    }

    public function createSubmitAction()
    {
        $name = $this->getPost('name');
        $dimension = $this->getPost('dimension');

        if (empty($name) || empty($dimension)) {
            return $this->createAction([
                'error' => 'Verify your input, some parameters are empty'
            ]);
        }
        $publisher = new PublisherModel();
        $publisher->setName($name);
        $publisher->setDimension($dimension);
        $publisher->save();

        $this->redirect('/publishers');
    }
}
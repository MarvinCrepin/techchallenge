<?php

namespace App\Controller;

use App\Model\MembersManager;

class MembersController extends AbstractController
{
    /**
     * List members
     */
    public function index(): string
    {
        $membersManager = new MembersManager();
        $members = $membersManager->selectAll('name');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $member = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $membersManager = new MembersManager();
            $membersManager->insert($member);
            header('Location: /');
        }
        return $this->twig->render('Home/index.html.twig', ['members' => $members]);
    }
    }

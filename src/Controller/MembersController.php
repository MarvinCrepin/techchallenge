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
            if (!empty($member['name'])){
                $membersManager = new MembersManager();
                $membersManager->insert($member);
                header('Location: /');
            }

        }
        return $this->twig->render('Home/index.html.twig', ['members' => $members]);
    }
    }

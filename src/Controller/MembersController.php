<?php

namespace App\Controller;

use App\Model\MembersManager;
use Exception;

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
            if(!empty($member['name'])){
                $membersManager = new MembersManager();
                $membersManager->insert($member);
                header('Location: /');
            }
            else {
                throw new Exception('Tu dois entrer un nom !');
            }
            // if validation is ok, insert and redirection
        }
        return $this->twig->render('Home/index.html.twig', ['members' => $members]);
    }
    }

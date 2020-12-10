<?php

namespace App\Controllers\Admin;

use App\app;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\AddForm;

class AddController extends AuthController
{
    protected $form;
    protected $page;

    public function __construct()
    {
        parent:: __construct();
        $this->form = new AddForm();
        $this->page = new BasePage([
            'title' => 'Add Pizza',
        ]);
    }

    public function add() {
        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();
            var_dump($clean_inputs);
            $clean_inputs['email'] = $_SESSION['email'];
            unset($clean_inputs['email']);
            App::$db->insertRow('pizzas', $clean_inputs);

            header('Location: /');
        }
        $this->page->setContent($this->form->render());

        return $this->page->render();
    }

}
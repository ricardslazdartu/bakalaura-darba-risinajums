<?php

class LanguageController
{
    /**
     * @throws Exception
     */
    public function index()
    {
        renderWithVariables('languages.index.php', ['languages' => LanguagesRepository::get()]);
    }

    public function showCreateLanguage()
    {
        renderWithVariables('languages.create.php');
    }

    /**
     * @throws Exception
     */
    public function showEditLanguage($id)
    {
        renderWithVariables('languages.create.php', ['language' => LanguagesRepository::getById($id)]);
    }

    /**
     * @throws Exception
     */
    public function create()
    {
        LanguagesRepository::create($_POST['name'], $_POST['key']);

        header('Location: ' . url('languagesIndex'));
    }

    /**
     * @throws Exception
     */
    public function edit($id)
    {
        LanguagesRepository::edit($id, $_POST['name'], $_POST['key']);
        header('Location: ' . url('languagesIndex'));
    }

    /**
     * @throws Exception
     */
    public function delete($id)
    {
        LanguagesRepository::delete($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
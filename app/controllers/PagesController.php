<?php

class PagesController
{
    /**
     * @throws Exception
     */
    public function index()
    {
        renderWithVariables('pages.index.php', ['pages' => PagesRepository::get()]);
    }

    public function showCreatePage()
    {
        renderWithVariables('pages.create.php');
    }

    /**
     * @throws Exception
     */
    public function showEditPage($id)
    {
        renderWithVariables('pages.create.php', ['page' => PagesRepository::getById($id)]);
    }

    /**
     * @throws Exception
     */
    public function create()
    {
        PagesRepository::create($_POST['name'], $_POST['link'], $_POST['key'], $this->getIsVisibleValue());

        header('Location: ' . url('pagesIndex'));
    }

    /**
     * @throws Exception
     */
    public function edit($id)
    {
        PagesRepository::edit($id, $_POST['name'], $_POST['link'], $_POST['key'], $this->getIsVisibleValue());
        header('Location: ' . url('pagesIndex'));
    }

    /**
     * @throws Exception
     */
    public function delete($id)
    {
        PagesRepository::delete($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    private function getIsVisibleValue()
    {
        if (!isset($_POST['isVisible'])) {
            return 0;
        }

        if ($_POST['isVisible'] == 'on') {
            $isVisible = 1;
        } else {
            $isVisible = 0;
        }

        return $isVisible;
    }
}
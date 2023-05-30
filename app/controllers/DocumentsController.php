<?php

class DocumentsController
{
    /**
     * @throws Exception
     */
    public function index()
    {
        renderWithVariables('documents.index.php', [
            'acceptedDocuments' => DocumentsRepository::getAccepted(),
            'documentsWaiting' => DocumentsRepository::getWaiting(),
            'documentsToChange' => DocumentsRepository::getToChange(),
        ]);
    }

    public function showCreateDocument()
    {
        renderWithVariables('documents.create.php');
    }

    /**
     * @throws Exception
     */
    public function showEditDocument($id)
    {
        renderWithVariables('documents.create.php', ['document' => DocumentsRepository::getById($id)]);
    }

    /**
     * @throws Exception
     */
    public function showAddChangeRequest($id)
    {
        renderWithVariables('documents.add_change_request.php', ['document' => DocumentsRepository::getById($id)]);
    }

    /**
     * @throws Exception
     */
    public function showChangeRequests($id)
    {
        renderWithVariables('documents.required_changes.php', ['document' => DocumentsRepository::getById($id), 'changeRequests' => DocumentsRepository::getChangeRequests($id)]);
    }

    /**
     * @throws Exception
     */
    public function createChangeRequest($id)
    {
        $date = date('Y-m-d H:i:s', time());
        DocumentsRepository::table();
        DocumentsRepository::createChangeRequest($_POST['content'], $id, 1, $date);
        DocumentsRepository::setChangesRequired($id);

        header('Location: ' . url('documentsIndex'));
    }

    /**
     * @throws Exception
     */
    public function create()
    {
        $date = date('Y-m-d H:i:s', time());
        DocumentsRepository::create($_POST['name'], $_POST['content'], DocumentsRepository::STATUS_NEW, $date, $_POST['validTill']);

        header('Location: ' . url('documentsIndex'));
    }

    /**
     * @throws Exception
     */
    public function edit($id)
    {
        if (isset($_POST['accept'])) {
            $date = date('Y-m-d H:i:s', time());
            DocumentsRepository::accept($id, $date);
            header('Location: ' . url('documentsIndex'));
        } else {
            DocumentsRepository::edit($id, $_POST['name'], $_POST['content'], $_POST['validTill']);
            DocumentsRepository::setNew($id);
            header('Location: ' . url('documentsIndex'));
        }
    }

    /**
     * @throws Exception
     */
    public function delete($id)
    {
        DocumentsRepository::delete($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
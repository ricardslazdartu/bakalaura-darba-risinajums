<?php

class ResourcesController
{
    /**
     * @throws Exception
     */
    public function index()
    {
        $resources = ResourcesRepository::get();
        $resourcesMapped = [];
        foreach ($resources as $resource) {
            $additionalData = ResourcesRepository::getFileCountAndSize($resource['id']);
            $resource['totalSize'] = $additionalData['totalSize'];
            $resource['count'] = $additionalData['count'];
            $resourcesMapped[] = $resource;
        }

        renderWithVariables('resources.index.php', ['resources' => $resourcesMapped]);
    }

    public function showCreateResource()
    {
        renderWithVariables('resources.create.php');
    }

    /**
     * @throws Exception
     */
    public function searchFiles()
    {
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $searchArray = explode(' ', $search);

            $files = [];

            foreach ($searchArray as $keywordSearch) {
                $keyword = ResourcesRepository::getByKeyword(trim(strtolower($keywordSearch)));
                if ($keyword) {
                    $file = ResourcesRepository::getFile($keyword['resource_file_id']);
                    $files[] = $file;
                }
            }

            renderWithVariables('resources.search_files.php', ['files' => $files]);
        } else {
            $resources = ResourcesRepository::get();
            renderWithVariables('resources.index.php', ['resources' => $resources]);
        }
    }

    /**
     * @throws Exception
     */
    public function showEditResource($id)
    {
        $files = [];

        foreach (ResourcesRepository::getFiles($id) as $file) {
            $keywords = ResourcesRepository::getKeywords($file['id']);
            $keys = array_column($keywords, 'key');
            $keywordString = implode(", ", $keys);

            $file['keywordString'] = $keywordString;
            $files[] = $file;
        }

        renderWithVariables('resources.create.php', ['resource' => ResourcesRepository::getById($id), 'files' => $files]);
    }

    /**
     * @throws Exception
     */
    public function create()
    {
        ResourcesRepository::create($_POST['name']);
        $resourceId = Database::getInstance()->lastInsertRowID();

        $target = './uploads/';

        if (isset($_FILES['resourceFiles'])) {
            $files = array_filter($_FILES['resourceFiles']['name']);
            $total = count($files);

            for ($i = 0; $i < $total; $i++) {
                $tmpPath = $_FILES['resourceFiles']['tmp_name'][$i];
                $size = filesize($tmpPath);
                $type = filetype($tmpPath);

                if ($tmpPath !== '') {
                    $path = $target . $_FILES['resourceFiles']['name'][$i];

                    if (!file_exists($path)) {
                        move_uploaded_file($tmpPath, $path);
                        ResourcesRepository::createFile($resourceId, $path, $type, $size);
                    }
                }
            }
        }

        header('Location: ' . url('resourcesIndex'));
    }

    /**
     * @throws Exception
     */
    public function edit($id)
    {
        if (isset($_POST['deleteFile'])) {
            $fileId = $_POST['fileId'];
            $file = ResourcesRepository::getFile($fileId);
            unlink($file['path']);
            ResourcesRepository::deleteFile($fileId);
            header('Location: ' . url('showEditResource', $id));
            return;
        }

        ResourcesRepository::edit($id, $_POST['name']);
        $files = ResourcesRepository::getFiles($id);

        foreach ($files as $file) {
            if (isset($_POST['keywords__' . $file['id']])) {
                $keywordsPost = $_POST['keywords__' . $file['id']];
                $keywordArray = explode(',', $keywordsPost);

                ResourcesRepository::deleteKeywords($file['id']);

                foreach ($keywordArray as $keyword) {
                    if ($keyword !== '') {
                        ResourcesRepository::createKeyword($file['id'], trim(strtolower($keyword)));
                    }
                }
            }
        }
        header('Location: ' . url('resourcesIndex'));
    }

    /**
     * @throws Exception
     */
    public function delete($id)
    {
        $files = ResourcesRepository::getFiles($id);

        foreach ($files as $file) {
            unlink($file['path']);
        }

        ResourcesRepository::delete($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
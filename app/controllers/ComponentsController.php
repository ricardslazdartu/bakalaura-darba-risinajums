<?php

class ComponentsController
{
    /**
     * @throws Exception
     */
    public function index()
    {
        $componentData = [];
        $components = ComponentsRepository::get();
        foreach ($components as $component) {
            $componentData[] = ['component' => $component, 'attributes' => AttributesRepository::getByComponentId($component['id'])];
        }

        renderWithVariables('components.index.php', ['componentsData' => $componentData]);
    }

    public function showCreateComponents()
    {
        renderWithVariables('components.create.php');
    }

    /**
     * @throws Exception
     */
    public function showEditComponent($id)
    {
        renderWithVariables('components.create.php', ['component' => ComponentsRepository::getById($id)]);
    }

    /**
     * @throws Exception
     */
    public function create()
    {
        ComponentsRepository::create($_POST['name'], $_POST['content']);
        $componentId = Database::getInstance()->lastInsertRowID();

        $uniqueAttributes = [];
        if (preg_match_all('~(%%\w+)~', $_POST['content'], $matches)) {
            foreach ($matches[1] as $word) {
                $attribute = substr($word, 2);
                if (!in_array($attribute, $uniqueAttributes)) {
                    AttributesRepository::create($componentId, $attribute);
                    $uniqueAttributes[] = $attribute;
                }
            }
        }

        header('Location: ' . url('componentsIndex'));
    }

    /**
     * @throws Exception
     */
    public function edit($id)
    {
        AttributesRepository::deleteByComponentId($id);

        if (preg_match_all('~(%%\w+)~', $_POST['content'], $matches)) {
            foreach ($matches[1] as $word) {
                $attribute = substr($word, 2);
                AttributesRepository::create($id, $attribute);
            }
        }

        ComponentsRepository::edit($id, $_POST['name'], $_POST['content']);
        header('Location: ' . url('componentsIndex'));
    }

    /**
     * @throws Exception
     */
    public function delete($id)
    {
        ComponentsRepository::delete($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
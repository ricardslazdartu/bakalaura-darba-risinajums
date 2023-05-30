<?php

class PagesComponentsController
{
    /**
     * @throws Exception
     */
    public function index($pageId)
    {
        $pageComponents = PageComponentsRepository::getComponentsByPageId($pageId);

        $pageComponentsData = [];
        foreach ($pageComponents as $pageComponent) {
            $pageComponent['component'] = ComponentsRepository::getById($pageComponent['component_id']);
            $pageComponentsData[] = $pageComponent;
        }

        renderWithVariables('page_components.index.php', ['pageComponents' => $pageComponentsData, 'page' => PagesRepository::getById($pageId)]);
    }

    /**
     * @throws Exception
     */
    public function showAddPageComponent($pageId)
    {
        $pageComponents = PageComponentsRepository::getComponentsByPageId($pageId);

        $pageComponentsData = [];
        foreach ($pageComponents as $pageComponent) {
            $pageComponent['component'] = ComponentsRepository::getById($pageComponent['component_id']);
            $pageComponentsData[] = $pageComponent;
        }

        renderWithVariables('page_components.add.php', ['pageComponents' => $pageComponentsData, 'components' => ComponentsRepository::get(), 'pageId' => $pageId]);
    }

    /**
     * @throws Exception
     */
    public function create($pageId)
    {
        $pageComponents = PageComponentsRepository::getComponentsByPageId($pageId);

        if (empty($pageComponents)) {
            PageComponentsRepository::create($pageId, $_POST['componentId'], 0, $_POST['isVisible']);
            header('Location: ' . url('pageComponentsIndex', $pageId));
            return;
        }

        $hasInserted = false;

        foreach ($pageComponents as $pageComponent) {
            if ($hasInserted) {
                PageComponentsRepository::updateOrderColumn($pageComponent['id'], $pageComponent['order'] + 1);
            } else {
                if ($pageComponent['order'] == $_POST['order']) {
                    PageComponentsRepository::create($pageId, $_POST['componentId'], $_POST['order'] + 1, $_POST['isVisible']);
                    $hasInserted = true;
                }
            }
        }

        header('Location: ' . url('pageComponentsIndex', $pageId));
    }

    /**
     * @throws Exception
     */
    public function delete($pageId, $pageComponentId)
    {
        PageComponentsRepository::deleteById($pageComponentId);

        $pageComponents = PageComponentsRepository::getComponentsByPageId($pageId);
        $i = 0;
        foreach ($pageComponents as $pageComponent) {
            PageComponentsRepository::updateOrderColumn($pageComponent['id'], $i);
            $i += 1;
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    /**
     * @throws Exception
     */
    public function showEditPage($pageId, $pageComponentId)
    {
        $pageComponent = PageComponentsRepository::getById($pageComponentId);
        $pageComponent['component'] = ComponentsRepository::getById($pageComponent['component_id']);
        $attributes = AttributesRepository::getByComponentId($pageComponent['component_id']);
        $languages = LanguagesRepository::get();

        $componentAttributes = ComponentAttributesRepository::getByPageComponentId($pageComponentId);

        renderWithVariables('page_components.edit.php', ['pageComponent' => $pageComponent, 'attributes' => $attributes, 'languages' => $languages, 'componentAttributes' => $componentAttributes]);
    }

    /**
     * @throws Exception
     */
    public function edit($pageId, $pageComponentId)
    {
        $pageComponent = PageComponentsRepository::getById($pageComponentId);
        $attributes = AttributesRepository::getByComponentId($pageComponent['component_id']);

        $componentAttributes = ComponentAttributesRepository::getByPageComponentId($pageComponentId);

        if (empty($componentAttributes)) {
            $isEditing = false;
        } else {
            $isEditing = true;
        }

        foreach ($attributes as $attribute) {
            $value = $_POST['attribute__' . $attribute['key']];
            if ($isEditing) {
                $componentAttributeId = $_POST['attribute_id__' . $attribute['key']];
                ComponentAttributesRepository::edit($componentAttributeId, $_POST['language'], $value);
            } else {
                ComponentAttributesRepository::create($pageComponentId, $attribute['id'], $_POST['language'], $value);
            }
        }

        header('Location: ' . url('pageComponentsIndex', $pageId));
    }
}
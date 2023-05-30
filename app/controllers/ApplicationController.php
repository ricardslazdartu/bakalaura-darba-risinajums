<?php

class ApplicationController
{
    /**
     * @throws Exception
     */
    public function handleApplication($routeData)
    {
        $page = PagesRepository::getVisibleByKey($routeData['name']);
        $pageComponents = PageComponentsRepository::getComponentsByPageId($page['id']);

        $html = '';
        $head = SettingsRepository::getByKey(SettingsRepository::HEADER_CONTENT_KEY)[0]['value'];

        $html .= $head;

        foreach ($pageComponents as $pageComponent) {
            $component = ComponentsRepository::getById($pageComponent['component_id']);
            $componentAttributes = ComponentAttributesRepository::getByPageComponentId($pageComponent['id']);

            $content = $component['content'];

            if (!empty($componentAttributes)) {
                foreach ($componentAttributes as $componentAttribute) {
                    $attribute = AttributesRepository::getById($componentAttribute['attribute_id']);
                    $content = str_replace( '%%' . $attribute['key'], $componentAttribute['value'], $content);
                }
            } else {
                $content = preg_replace("/(?<=^|\s)%%\w+/", "" , $content);
            }
            $html .= $content;
        }

        echo $html;
    }
}
<?php
/** PAGES */
Router::add('/admin/pages', PagesController::class, "index", Router::METHOD_GET, 'pagesIndex');
Router::add('/admin/pages/create', PagesController::class, "showCreatePage", Router::METHOD_GET, 'showCreatePage');
Router::add('/admin/pages/create', PagesController::class, "create", Router::METHOD_POST, 'createPage');
Router::add('/admin/pages/delete/([0-9]*)', PagesController::class, "delete", Router::METHOD_POST, 'deletePage');
Router::add('/admin/pages/edit/([0-9]*)', PagesController::class, "showEditPage", Router::METHOD_GET, 'showEditPage');
Router::add('/admin/pages/edit/([0-9]*)', PagesController::class, "edit", Router::METHOD_POST, 'editPage');

/** COMPONENTS */
Router::add('/admin/components', ComponentsController::class, "index", Router::METHOD_GET, 'componentsIndex');
Router::add('/admin/components/create', ComponentsController::class, "showCreateComponents", Router::METHOD_GET, 'showCreateComponents');
Router::add('/admin/components/create', ComponentsController::class, "create", Router::METHOD_POST, 'createComponent');
Router::add('/admin/components/delete/([0-9]*)', ComponentsController::class, "delete", Router::METHOD_POST, 'deleteComponent');
Router::add('/admin/components/edit/([0-9]*)', ComponentsController::class, "showEditComponent", Router::METHOD_GET, 'showEditComponent');
Router::add('/admin/components/edit/([0-9]*)', ComponentsController::class, "edit", Router::METHOD_POST, 'editComponent');

Router::add('/admin/pages/([0-9]*)/components', PagesComponentsController::class, "index", Router::METHOD_GET, 'pageComponentsIndex');
Router::add('/admin/pages/([0-9]*)/components/add', PagesComponentsController::class, "showAddPageComponent", Router::METHOD_GET, 'showAddPageComponent');
Router::add('/admin/pages/([0-9]*)/components/create', PagesComponentsController::class, "create", Router::METHOD_POST, 'createPageComponent');
Router::add('/admin/pages/([0-9]*)/components/delete/([0-9]*)', PagesComponentsController::class, "delete", Router::METHOD_POST, 'deletePageComponent');
Router::add('/admin/pages/([0-9]*)/components/edit/([0-9]*)', PagesComponentsController::class, "showEditPage", Router::METHOD_GET, 'showEditPageComponent');
Router::add('/admin/pages/([0-9]*)/components/edit/([0-9]*)', PagesComponentsController::class, "edit", Router::METHOD_POST, 'editPageComponent');

Router::add('/admin/languages', LanguageController::class, "index", Router::METHOD_GET, 'languagesIndex');
Router::add('/admin/languages/create', LanguageController::class, "showCreateLanguage", Router::METHOD_GET, 'showCreateLanguage');
Router::add('/admin/languages/create', LanguageController::class, "create", Router::METHOD_POST, 'createLanguage');
Router::add('/admin/languages/delete/([0-9]*)', LanguageController::class, "delete", Router::METHOD_POST, 'deleteLanguage');
Router::add('/admin/languages/edit/([0-9]*)', LanguageController::class, "showEditLanguage", Router::METHOD_GET, 'showEditLanguage');
Router::add('/admin/languages/edit/([0-9]*)', LanguageController::class, "edit", Router::METHOD_POST, 'editLanguage');

Router::add('/admin/resources', ResourcesController::class, "index", Router::METHOD_GET, 'resourcesIndex');
Router::add('/admin/resources/create', ResourcesController::class, "showCreateResource", Router::METHOD_GET, 'showCreateResource');
Router::add('/admin/resources/create', ResourcesController::class, "create", Router::METHOD_POST, 'createResource');
Router::add('/admin/resources/create', ResourcesController::class, "showCreateResource", Router::METHOD_GET, 'showCreateResource');
Router::add('/admin/resources/delete/([0-9]*)', ResourcesController::class, "delete", Router::METHOD_POST, 'deleteResource');
Router::add('/admin/resources/edit/([0-9]*)', ResourcesController::class, "showEditResource", Router::METHOD_GET, 'showEditResource');
Router::add('/admin/resources/edit/([0-9]*)', ResourcesController::class, "edit", Router::METHOD_POST, 'editResource');
Router::add('/admin/resources/search', ResourcesController::class, "searchFiles", Router::METHOD_POST, 'searchFiles');

Router::add('/admin/documents', DocumentsController::class, "index", Router::METHOD_GET, 'documentsIndex');
Router::add('/admin/documents/create', DocumentsController::class, "showCreateDocument", Router::METHOD_GET, 'showCreateDocument');
Router::add('/admin/documents/create', DocumentsController::class, "create", Router::METHOD_POST, 'createDocument');
Router::add('/admin/documents/delete/([0-9]*)', DocumentsController::class, "delete", Router::METHOD_POST, 'deleteDocument');
Router::add('/admin/documents/edit/([0-9]*)', DocumentsController::class, "showEditDocument", Router::METHOD_GET, 'showEditDocument');
Router::add('/admin/documents/edit/([0-9]*)', DocumentsController::class, "edit", Router::METHOD_POST, 'editDocument');

Router::add('/admin/documents/changes/([0-9]*)', DocumentsController::class, "showChangeRequests", Router::METHOD_GET, 'showChangeRequests');
Router::add('/admin/documents/change/([0-9]*)', DocumentsController::class, "showAddChangeRequest", Router::METHOD_GET, 'showChangeRequest');
Router::add('/admin/documents/change/([0-9]*)', DocumentsController::class, "createChangeRequest", Router::METHOD_POST, 'createChangeRequest');

Router::add('/admin/settings', SettingsController::class, "index", Router::METHOD_GET, 'settingsIndex');
Router::add('/admin/settings/edit', SettingsController::class, "edit", Router::METHOD_POST, 'editSettings');

Router::add('/login', LoginController::class, "showLoginPage", Router::METHOD_GET, 'showLoginPage');
Router::add('/login', LoginController::class, "authorizeUser", Router::METHOD_POST, 'authorizeUser');
Router::add('/logout', LoginController::class, "logout", Router::METHOD_GET, 'logout');

try {
    foreach (PagesRepository::get() as $page) {
        Router::add($page['link'], ApplicationController::class, "handle", Router::METHOD_GET, $page['key']);
    }
} catch (Exception $e) {
}

Router::setRouteNotFoundHandler(ErrorController::class, "handleRouteNotFound");
Router::setApplicationHandler(ApplicationController::class, "handleApplication");
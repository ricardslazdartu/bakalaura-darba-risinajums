<?php
session_start();

require_once 'app/core/Database.php';
require_once 'app/core/Helpers.php';
require_once 'app/repositories/PagesRepository.php';
require_once 'app/core/routing/Router.php';
require_once 'app/core/routing/Routes.php';

require_once 'app/repositories/ComponentsRepository.php';
require_once 'app/repositories/AttributesRepository.php';
require_once 'app/repositories/PageComponentsRepository.php';
require_once 'app/repositories/LanguagesRepository.php';
require_once 'app/repositories/ComponentAttributesRepository.php';
require_once 'app/repositories/SettingsRepository.php';
require_once 'app/repositories/ResourcesRepository.php';
require_once 'app/repositories/DocumentsRepository.php';
require_once 'app/repositories/UsersRepository.php';

require_once 'app/controllers/PagesController.php';
require_once 'app/controllers/ComponentsController.php';
require_once 'app/controllers/PagesComponentsController.php';
require_once 'app/controllers/LanguageController.php';
require_once 'app/controllers/ErrorController.php';
require_once 'app/controllers/ApplicationController.php';
require_once 'app/controllers/SettingsController.php';
require_once 'app/controllers/ResourcesController.php';
require_once 'app/controllers/DocumentsController.php';
require_once 'app/controllers/LoginController.php';

Router::run();


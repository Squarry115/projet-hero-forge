<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_wdt/styles' => [[['_route' => '_wdt_stylesheet', '_controller' => 'web_profiler.controller.profiler::toolbarStylesheetAction'], null, null, null, false, false, null]],
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin' => [[['_route' => 'app_admin', '_controller' => 'App\\Controller\\AdminController::index'], null, null, null, false, false, null]],
        '/admin/races' => [[['_route' => 'admin_race_index', '_controller' => 'App\\Controller\\AdminController::races'], null, null, null, false, false, null]],
        '/admin/races/new' => [[['_route' => 'admin_race_new', '_controller' => 'App\\Controller\\AdminController::newRace'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/classes' => [[['_route' => 'admin_class_index', '_controller' => 'App\\Controller\\AdminController::classes'], null, null, null, false, false, null]],
        '/admin/classes/new' => [[['_route' => 'admin_class_new', '_controller' => 'App\\Controller\\AdminController::newClass'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/skills' => [[['_route' => 'admin_skill_index', '_controller' => 'App\\Controller\\AdminController::skills'], null, null, null, false, false, null]],
        '/admin/skills/new' => [[['_route' => 'admin_skill_new', '_controller' => 'App\\Controller\\AdminController::newSkill'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/v1/characters' => [[['_route' => 'api_characters', '_controller' => 'App\\Controller\\Api\\ApiCharacterController::list'], null, ['GET' => 0], null, false, false, null]],
        '/api/v1/classes' => [[['_route' => 'api_classes', '_controller' => 'App\\Controller\\Api\\ApiClassController::list'], null, ['GET' => 0], null, false, false, null]],
        '/api/v1/parties' => [[['_route' => 'api_parties', '_controller' => 'App\\Controller\\Api\\ApiPartyController::list'], null, ['GET' => 0], null, false, false, null]],
        '/api/v1/races' => [[['_route' => 'api_races', '_controller' => 'App\\Controller\\Api\\ApiRaceController::list'], null, ['GET' => 0], null, false, false, null]],
        '/api/v1/skills' => [[['_route' => 'api_skills', '_controller' => 'App\\Controller\\Api\\ApiSkillController::list'], null, ['GET' => 0], null, false, false, null]],
        '/character' => [[['_route' => 'app_character_index', '_controller' => 'App\\Controller\\CharacterController::index'], null, ['GET' => 0], null, false, false, null]],
        '/character/new' => [[['_route' => 'app_character_new', '_controller' => 'App\\Controller\\CharacterController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\HomeController::index'], null, null, null, false, false, null]],
        '/party' => [[['_route' => 'app_party_index', '_controller' => 'App\\Controller\\PartyController::index'], null, ['GET' => 0], null, false, false, null]],
        '/party/new' => [[['_route' => 'app_party_new', '_controller' => 'App\\Controller\\PartyController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\RegistrationController::register'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/a(?'
                    .'|dmin/(?'
                        .'|races/([^/]++)/(?'
                            .'|edit(*:237)'
                            .'|delete(*:251)'
                        .')'
                        .'|classes/([^/]++)/(?'
                            .'|edit(*:284)'
                            .'|delete(*:298)'
                        .')'
                        .'|skills/([^/]++)/(?'
                            .'|edit(*:330)'
                            .'|delete(*:344)'
                        .')'
                    .')'
                    .'|pi/v1/(?'
                        .'|c(?'
                            .'|haracters/([^/]++)(*:385)'
                            .'|lasses/([^/]++)(*:408)'
                        .')'
                        .'|parties/([^/]++)(*:433)'
                        .'|races/([^/]++)(*:455)'
                    .')'
                .')'
                .'|/character/([^/]++)(?'
                    .'|(*:487)'
                    .'|/(?'
                        .'|edit(*:503)'
                        .'|delete(*:517)'
                    .')'
                .')'
                .'|/party/([^/]++)(?'
                    .'|(*:545)'
                    .'|/(?'
                        .'|join/([^/]++)(*:570)'
                        .'|leave/([^/]++)(*:592)'
                        .'|delete(*:606)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        237 => [[['_route' => 'admin_race_edit', '_controller' => 'App\\Controller\\AdminController::editRace'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        251 => [[['_route' => 'admin_race_delete', '_controller' => 'App\\Controller\\AdminController::deleteRace'], ['id'], ['POST' => 0], null, false, false, null]],
        284 => [[['_route' => 'admin_class_edit', '_controller' => 'App\\Controller\\AdminController::editClass'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        298 => [[['_route' => 'admin_class_delete', '_controller' => 'App\\Controller\\AdminController::deleteClass'], ['id'], ['POST' => 0], null, false, false, null]],
        330 => [[['_route' => 'admin_skill_edit', '_controller' => 'App\\Controller\\AdminController::editSkill'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        344 => [[['_route' => 'admin_skill_delete', '_controller' => 'App\\Controller\\AdminController::deleteSkill'], ['id'], ['POST' => 0], null, false, false, null]],
        385 => [[['_route' => 'api_character_show', '_controller' => 'App\\Controller\\Api\\ApiCharacterController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        408 => [[['_route' => 'api_class_show', '_controller' => 'App\\Controller\\Api\\ApiClassController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        433 => [[['_route' => 'api_party_show', '_controller' => 'App\\Controller\\Api\\ApiPartyController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        455 => [[['_route' => 'api_race_show', '_controller' => 'App\\Controller\\Api\\ApiRaceController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        487 => [[['_route' => 'app_character_show', '_controller' => 'App\\Controller\\CharacterController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        503 => [[['_route' => 'app_character_edit', '_controller' => 'App\\Controller\\CharacterController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        517 => [[['_route' => 'app_character_delete', '_controller' => 'App\\Controller\\CharacterController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        545 => [[['_route' => 'app_party_show', '_controller' => 'App\\Controller\\PartyController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        570 => [[['_route' => 'app_party_join', '_controller' => 'App\\Controller\\PartyController::join'], ['id', 'characterId'], ['POST' => 0], null, false, true, null]],
        592 => [[['_route' => 'app_party_leave', '_controller' => 'App\\Controller\\PartyController::leave'], ['id', 'characterId'], ['POST' => 0], null, false, true, null]],
        606 => [
            [['_route' => 'app_party_delete', '_controller' => 'App\\Controller\\PartyController::delete'], ['id'], ['POST' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

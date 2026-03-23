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
        '/api/v1/characters' => [[['_route' => 'api_characters', '_controller' => 'App\\Controller\\Api\\ApiCharacterController::list'], null, ['GET' => 0], null, false, false, null]],
        '/api/v1/classes' => [[['_route' => 'api_classes', '_controller' => 'App\\Controller\\Api\\ApiClassController::list'], null, ['GET' => 0], null, false, false, null]],
        '/api/v1/parties' => [[['_route' => 'api_parties', '_controller' => 'App\\Controller\\Api\\ApiPartyController::list'], null, ['GET' => 0], null, false, false, null]],
        '/api/v1/races' => [[['_route' => 'api_races', '_controller' => 'App\\Controller\\Api\\ApiRaceController::list'], null, ['GET' => 0], null, false, false, null]],
        '/api/v1/skills' => [[['_route' => 'api_skills', '_controller' => 'App\\Controller\\Api\\ApiSkillController::list'], null, ['GET' => 0], null, false, false, null]],
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
                .'|/api/v1/(?'
                    .'|c(?'
                        .'|haracters/([^/]++)(*:235)'
                        .'|lasses/([^/]++)(*:258)'
                    .')'
                    .'|parties/([^/]++)(*:283)'
                    .'|races/([^/]++)(*:305)'
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
        235 => [[['_route' => 'api_character_show', '_controller' => 'App\\Controller\\Api\\ApiCharacterController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        258 => [[['_route' => 'api_class_show', '_controller' => 'App\\Controller\\Api\\ApiClassController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        283 => [[['_route' => 'api_party_show', '_controller' => 'App\\Controller\\Api\\ApiPartyController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        305 => [
            [['_route' => 'api_race_show', '_controller' => 'App\\Controller\\Api\\ApiRaceController::show'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

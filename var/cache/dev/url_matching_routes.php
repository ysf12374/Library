<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/author/book' => [[['_route' => 'author_book', '_controller' => 'App\\Controller\\AuthorBookController::index'], null, null, null, false, false, null]],
        '/save' => [[['_route' => 'save', '_controller' => 'App\\Controller\\AuthorBookController::saves'], null, null, null, false, false, null]],
        '/gets' => [[['_route' => 'gets', '_controller' => 'App\\Controller\\AuthorBookController::gets'], null, null, null, false, false, null]],
        '/api/authors' => [
            [['_route' => 'postAuthors', '_controller' => 'App\\Controller\\AuthorBookController::apiAuthors'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'getAllAuthors', '_controller' => 'App\\Controller\\AuthorBookController::apiAuthorsAll'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/books' => [
            [['_route' => 'postBooks', '_controller' => 'App\\Controller\\AuthorBookController::apiBooks'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'getAllBooks', '_controller' => 'App\\Controller\\AuthorBookController::apiBooksAll'], null, ['GET' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api(?'
                    .'|/(?'
                        .'|authors/([^/]++)(?'
                            .'|(*:72)'
                            .'|/delete(*:86)'
                        .')'
                        .'|books/([^/]++)(?'
                            .'|(*:111)'
                            .'|/delete(*:126)'
                        .')'
                    .')'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:164)'
                    .'|/(?'
                        .'|docs(?:\\.([^/]++))?(*:195)'
                        .'|contexts/(.+)(?:\\.([^/]++))?(*:231)'
                        .'|authors(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:267)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:305)'
                            .')'
                        .')'
                        .'|books(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:341)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:379)'
                            .')'
                        .')'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        72 => [
            [['_route' => 'putAuthors', '_controller' => 'App\\Controller\\AuthorBookController::apiAuthorsEdit'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => '=getAuthor', '_controller' => 'App\\Controller\\AuthorBookController::apiAuthor'], ['id'], ['GET' => 0], null, false, true, null],
        ],
        86 => [[['_route' => '=delAuthor', '_controller' => 'App\\Controller\\AuthorBookController::apiAuthorDelete'], ['id'], ['POST' => 0], null, false, false, null]],
        111 => [
            [['_route' => 'putBook', '_controller' => 'App\\Controller\\AuthorBookController::apiBooksEdit'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => '=getBook', '_controller' => 'App\\Controller\\AuthorBookController::apiBook'], ['id'], ['GET' => 0], null, false, true, null],
        ],
        126 => [[['_route' => '=delBook', '_controller' => 'App\\Controller\\AuthorBookController::apiBookDelete'], ['id'], ['POST' => 0], null, false, false, null]],
        164 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], null, null, false, true, null]],
        195 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], null, null, false, true, null]],
        231 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], null, null, false, true, null]],
        267 => [
            [['_route' => 'api_authors_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Author', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_authors_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Author', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        305 => [
            [['_route' => 'api_authors_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Author', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_authors_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Author', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_authors_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Author', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_authors_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Author', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
        ],
        341 => [
            [['_route' => 'api_books_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Book', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_books_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Book', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        379 => [
            [['_route' => 'api_books_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Book', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_books_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Book', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_books_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Book', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_books_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Book', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

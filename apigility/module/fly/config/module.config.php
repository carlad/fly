<?php
return array(
    'router' => array(
        'routes' => array(
            'fly.rest.supportedorigins' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/supportedorigins[/:supportedorigins_id]',
                    'defaults' => array(
                        'controller' => 'fly\\V1\\Rest\\Supportedorigins\\Controller',
                    ),
                ),
            ),
            'fly.rest.search' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/search[/:search_id]',
                    'defaults' => array(
                        'controller' => 'fly\\V1\\Rest\\Search\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'fly.rest.supportedorigins',
            1 => 'fly.rest.search',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'fly\\V1\\Rest\\Supportedorigins\\SupportedoriginsResource' => 'fly\\V1\\Rest\\Supportedorigins\\SupportedoriginsResourceFactory',
            'fly\\V1\\Rest\\Search\\SearchResource' => 'fly\\V1\\Rest\\Search\\SearchResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'fly\\V1\\Rest\\Supportedorigins\\Controller' => array(
            'listener' => 'fly\\V1\\Rest\\Supportedorigins\\SupportedoriginsResource',
            'route_name' => 'fly.rest.supportedorigins',
            'route_identifier_name' => 'supportedorigins_id',
            'collection_name' => 'supportedorigins',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => '100',
            'page_size_param' => null,
            'entity_class' => 'fly\\V1\\Rest\\Supportedorigins\\SupportedoriginsEntity',
            'collection_class' => 'fly\\V1\\Rest\\Supportedorigins\\SupportedoriginsCollection',
            'service_name' => 'supportedorigins',
        ),
        'fly\\V1\\Rest\\Search\\Controller' => array(
            'listener' => 'fly\\V1\\Rest\\Search\\SearchResource',
            'route_name' => 'fly.rest.search',
            'route_identifier_name' => 'search_id',
            'collection_name' => 'search',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'fly\\V1\\Rest\\Search\\SearchEntity',
            'collection_class' => 'fly\\V1\\Rest\\Search\\SearchCollection',
            'service_name' => 'search',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'fly\\V1\\Rest\\Supportedorigins\\Controller' => 'HalJson',
            'fly\\V1\\Rest\\Search\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'fly\\V1\\Rest\\Supportedorigins\\Controller' => array(
                0 => 'application/vnd.fly.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'fly\\V1\\Rest\\Search\\Controller' => array(
                0 => 'application/vnd.fly.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'fly\\V1\\Rest\\Supportedorigins\\Controller' => array(
                0 => 'application/vnd.fly.v1+json',
                1 => 'application/json',
            ),
            'fly\\V1\\Rest\\Search\\Controller' => array(
                0 => 'application/vnd.fly.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'fly\\V1\\Rest\\Supportedorigins\\SupportedoriginsEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fly.rest.supportedorigins',
                'route_identifier_name' => 'supportedorigins_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'fly\\V1\\Rest\\Supportedorigins\\SupportedoriginsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fly.rest.supportedorigins',
                'route_identifier_name' => 'supportedorigins_id',
                'is_collection' => true,
            ),
            'fly\\V1\\Rest\\Search\\SearchEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fly.rest.search',
                'route_identifier_name' => 'search_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'fly\\V1\\Rest\\Search\\SearchCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fly.rest.search',
                'route_identifier_name' => 'search_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'fly\\V1\\Rest\\Search\\Controller' => array(
            'input_filter' => 'fly\\V1\\Rest\\Search\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'fly\\V1\\Rest\\Search\\Validator' => array(
            0 => array(
                'name' => 'originAirport',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '3',
                            'max' => '3',
                        ),
                    ),
                ),
                'error_message' => 'You must provide an origin airport.',
            ),
            1 => array(
                'name' => 'fromDate',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Date',
                        'options' => array(
                            'format' => 'yyyy-mm-dd',
                        ),
                    ),
                ),
                'error_message' => 'You must provide a from date.',
            ),
            2 => array(
                'name' => 'toDate',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Date',
                        'options' => array(
                            'format' => 'yyyy-mm-dd',
                        ),
                    ),
                ),
                'error_message' => 'You must provide a to date.',
            ),
            3 => array(
                'name' => 'weatherPreferences',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                        ),
                    ),
                ),
                'error_message' => 'You  must provide a weather preference.',
            ),
        ),
    ),
);

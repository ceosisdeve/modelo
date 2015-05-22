<?php

return array(
    'doctrine' => array(
        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array(
                    'LosLog\Log\EntityLogger'
                )
            )
        ),
        'configuration' => array(
            'orm_default' => array(
                'query_cache' => 'array',
                'result_cache' => 'array',
                'metadata_cache' => 'array'
            )
        ),
        'connection' => array(
            'orm_default' => array(
                'params' => array(
                    'password' => 'modelo'
                )
            )
        )
    )
);
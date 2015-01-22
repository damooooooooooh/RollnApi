<?php
return array(
    'data-fixture' => array(
        'RollNApi_fixture' => __DIR__ . '/../src/RollNApi/Fixture',
    ),

    'doctrine' => array(
        'driver' => array(
            'rollnapi_driver' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\XmlDriver',
                'paths' => array(
                    0 => __DIR__ . '/xml',
                ),
            ),
            'orm_default' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\DriverChain',
                'drivers' => array(
                    'RollNApi\\Entity' => 'rollnapi_driver',
                ),
            ),
        ),
    ),
);
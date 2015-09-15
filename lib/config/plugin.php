<?php

return array(
    'name' => 'Маска для телефона',
    'description' => 'Ввод телефона по маске заданного формата',
    'vendor' => '985310',
    'version' => '1.0.0',
    'img' => 'img/phmask.png',
    'shop_settings' => true,
    'frontend' => true,
    'handlers' => array(
        'frontend_head' => 'frontendHead',
    ),
);
//EOF

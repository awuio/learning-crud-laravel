<?php

return [
    'unique' => 'This information is already in use. Please use another one.',
    'required' => 'Please fill out this field.',
    'email' => 'Invalid email format.',
    'confirmed' => 'Password and password confirmation do not match.',

    'custom' => [
        'email' => [
            'unique' => 'This email is already registered. Please use another one.',
            'required' => 'Please enter your email.',
            'email' => 'Invalid email format.',
        ],
        'name' => [
            'required' => 'Please enter your name.',
        ],
        'password' => [
            'required' => 'Please enter a password.',
            'confirmed' => 'Password and password confirmation do not match.',
        ],
    ],
];

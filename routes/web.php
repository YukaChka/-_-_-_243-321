<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contacts', function () {
    $contacts = [
        [
            'name'  => 'Шуфер Максим Александрович',
            'phone' => '+7 (999) 123-45-67',
            'email' => 'maxzerovol@gmail.com',
        ],
        [
            'name'  => 'Администратор сайта',
            'phone' => '+7 (800) 555-35-35',
            'email' => 'admin@news-site.ru',
        ],
        [
            'name'  => 'Редакция',
            'phone' => '+7 (495) 000-11-22',
            'email' => 'editor@news-site.ru',
        ],
    ];

    return view('contacts', ['contacts' => $contacts]);
});

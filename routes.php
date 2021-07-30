<?php

use App\Controllers\Donation;
use App\Controllers\Pages;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', [Pages::class, 'index']);
SimpleRouter::get('/cancel', [Pages::class, 'cancel']);
SimpleRouter::get('/confirmed', [Pages::class, 'confirmed']);

SimpleRouter::post('donation/store', [Donation::class, 'store'])->setName('donation.store');

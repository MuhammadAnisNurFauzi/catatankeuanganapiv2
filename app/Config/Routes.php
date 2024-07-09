<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->resource('user');
$routes->resource('pemasukan');
$routes->resource('pengeluaran');
$routes->resource('transaksi');
$routes->resource('laporan');
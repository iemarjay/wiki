<?php


namespace App\Contracts;


interface DB
{
    public function store(array $attributes);

    public function find($id, $columns = '*');
}

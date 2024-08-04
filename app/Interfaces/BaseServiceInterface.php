<?php

namespace App\Interfaces;

interface BaseServiceInterface
{
    public function index($request = null);
    public function store(array $params);
    public function detail(int $id);
    public function update(int $id, array $params);
    public function delete(int $id);

}

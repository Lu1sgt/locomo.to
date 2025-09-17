<?php

interface Database_Interface 
{
    public function search(string $table, array $data);
    public function create(string $table, array $data);
    public function update(string $table, array $data);
    public function delete(string $table, array $data);
}
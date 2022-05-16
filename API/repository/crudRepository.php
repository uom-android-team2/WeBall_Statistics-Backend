<?php

interface CRUDRepository {
    public function findById($id);
    public function findAll();
    public function deleteById($id);
    public function deleteAll();
    public function save($entity);
    public function update($entity);
    public function count();
}

?>
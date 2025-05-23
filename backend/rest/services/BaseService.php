<?php

class BaseService {
    protected $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function add($entity) {
        return $this->dao->add($entity);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }

    public function update($id, $entity) {
        return $this->dao->update($id, $entity);
    }

    public function getAll() {
        return $this->dao->getAll();
    }
}

?>
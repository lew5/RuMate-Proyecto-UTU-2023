<?php

class LoteRepository extends Repository
{
  public function __construct()
  {
    parent::__construct("lotes","id_lote","Lote");
  }

  public function find()
  {
    return $this->read();
  }

  public function findById($id)
  {
    return $this->read(
      [
        "$this->idColumn" => $id
      ]
    );
  }

  public function addLote($data)
  {
    $this->create($data);
    return $this->lastInsertId();
  }

  public function updateLote($id, $data)
  {
    $this->update($id, $data);
  }

  public function deleteLote($id)
  {
    $this->delete($id);
  }
}
?>

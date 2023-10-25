<?php

class LoteService
{
  private $loteRepository;
  private $fichaService;
  private $categoriaRepository;

  private $usuarioService;
  public function __construct()
  {
    $this->loteRepository = Container::resolve(LoteRepository::class);
    $this->categoriaRepository = Container::resolve(CategoriaRepository::class);
    $this->fichaService = Container::resolve(FichaService::class);
    $this->usuarioService = Container::resolve(UsuarioService::class);
  }

  public function getLotes()
  {
    return $this->loteRepository->find();
  }

  public function getLoteById($id)
  {
    $lote = $this->loteRepository->findById($id);
    if ($lote) {
      $idFicha = $lote->getIdFicha();
      $ficha = $this->fichaService->getFichaById($idFicha);
      $idCategoria = $lote->getIdCategoria();
      $categoria = $this->categoriaRepository->findById($idCategoria);
      $idProveedor = $lote->getIdProveedor();
      $proveedor = $this->usuarioService->getUsuarioById($idProveedor);
      $lote->setFicha($ficha);
      $lote->setCategoria($categoria);
      $lote->setProveedor($proveedor);
      return $lote;
    }
    abort(404);

  }

  public function createLote($loteModel)
  {
    $fichaId = $this->fichaService->createFicha($loteModel->getFicha());
    $loteModel->setIdFicha($fichaId);
    $loteAssocArray = $this->loteToAssocArray($loteModel);
    $this->loteRepository->addLote($loteAssocArray);
    return $this->loteRepository->lastInsertId();
  }

  public function updateLote($id, $data)
  {
    $this->loteRepository->updateLote($id, $data);
  }

  public function deleteLote($id)
  {
    $this->loteRepository->beginTransaction();
    try {
      $fichaId = $this->loteRepository->getFichaIdByLoteId($id)->getIdFicha();
      $this->loteRepository->deleteLote($id);
      $this->fichaService->deleteFicha($fichaId);
      $this->loteRepository->commit();
    } catch (PDOException $e) {
      $this->loteRepository->rollback();
    } finally {
      $this->loteRepository->close();
    }
  }

  private function loteToAssocArray($loteModel)
  {
    return [
      "imagen_lote" => $loteModel->getImagen(),
      "precio_base_lote" => $loteModel->getPrecioBase(),
      "mejor_oferta_lote" => $loteModel->getMejorOferta(),
      "id_proveedor_lote" => $loteModel->getIdProveedor(),
      "id_ficha_lote" => $loteModel->getIdFicha(),
      "id_categoria_lote" => $loteModel->getIdCategoria()
    ];
  }
}
?>
<?php

class PersonaService
{
  private $personaRepository;

  public function __construct()
  {
    $this->personaRepository = Container::resolve(PersonaRepository::class);
  }

  public function createPersona($personaModel)
  {
    $personaToAssocArray = $this->personaToAssocArray($personaModel);
    $this->personaRepository->addPersona($personaToAssocArray);
    return $this->personaRepository->lastInsertId();
  }

  public function getPersona()
  {
    return $this->personaRepository->find();
  }
  public function getPersonaById($id)
  {
    return $this->personaRepository->findById($id);
  }

  public function updatePersona($id, $data)
  {
    $this->personaRepository->updatePersona($id, $data);
  }

  public function deletePersona($id)
  {
    $this->personaRepository->deletePersona($id);
  }

  private function personaToAssocArray($personaModel)
  {
    return [
      "nombre_persona" => $personaModel->getNombre(),
      "apellido_persona" => $personaModel->getApellido(),
      "ci_persona" => $personaModel->getCi(),
      "barrio_persona" => $personaModel->getBarrio(),
      "calle_persona" => $personaModel->getCalle(),
      "numero_persona" => $personaModel->getNumero(),
      "telefono_persona" => $personaModel->getTelefono(),
      "estado_persona" => $personaModel->getEstado()
    ];
  }
}
?>
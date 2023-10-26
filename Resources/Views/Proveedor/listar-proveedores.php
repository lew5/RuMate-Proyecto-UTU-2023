<div class="card-container f-column">
  <?php
  if ($proveedores != false) {
    foreach ($proveedores as $proveedor) {
      $imagen_nombre = $proveedor->getUsuario()->getImagen();
      if (!empty($imagen_nombre) && file_exists(BASE_PATH . "/Public/imgs/Usuario/" . $imagen_nombre)) {
        $imagen_path = PUBLIC_PATH . "/Public/imgs/Usuario/" . $imagen_nombre;
      } else {
        $imagen_path = PUBLIC_PATH . "/Public/imgs/Usuario/proveedor-no-image.webp";
      }
      $proveedor->getUsuario()->setImagen($imagen_path);
      $view = Container::resolve(View::class);
      $view->assign("proveedor", $proveedor);
      $view->render(BASE_PATH . "/Resources/Views/Proveedor/card-proveedor.php");
    }
  } else {
    // abort(500); //no se encontraron proveedores
  }
  ?>
</div>
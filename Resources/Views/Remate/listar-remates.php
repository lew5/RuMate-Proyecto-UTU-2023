<div class="card-container f-column">
  <?php
  if ($remates != false) {
    foreach ($remates as $remate) {
      $imagen_nombre = $remate->getImagen();
      if (!empty($imagen_nombre) && file_exists(BASE_PATH . "/Public/imgs/remate/" . $imagen_nombre)) {
        $imagen_path = PUBLIC_PATH . "/Public/imgs/remate/" . $imagen_nombre;
      } else {
        $imagen_path = PUBLIC_PATH . "/Public/imgs/no-image.webp";
      }
      $remate->setImagen($imagen_path);
      $view = Container::resolve(View::class);
      $view->assign("remate", $remate);
      $view->render(BASE_PATH . "/Resources/Views/Remate/card-remate.php");
    }

  } else {
    var_dump("no se encontraron remates"); //cambiar a algo mas mejor
  }
  ?>
</div>
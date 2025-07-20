<?php

// Rutas original instaladas por Breeze
$newRoutes = file_get_contents(__DIR__ . '/web.php');

// Rutas que tenías antes (backup)
$oldRoutes = file_get_contents(__DIR__ . '/web_backup.php');

// Extraemos el contenido entre los tags php y sin comentarios para no duplicar
// Aquí puedes hacer una limpieza si quieres, pero para empezar, vamos a insertar las tuyas justo antes de 'require __DIR__.'/auth.php';'

$insertPoint = "require __DIR__.'/auth.php';";

// Busca dónde insertar las rutas antiguas en el nuevo web.php
$pos = strpos($newRoutes, $insertPoint);

if ($pos === false) {
    echo "No se encontró el punto de inserción en web.php\n";
    exit(1);
}

// Extraemos todo lo que está antes y después del punto de inserción
$before = substr($newRoutes, 0, $pos);
$after = substr($newRoutes, $pos);

// Quitamos las etiquetas <?php y comentarios del backup para evitar duplicados

// Para esto, quitamos la primera línea <?php y comentarios al principio
$oldRoutesClean = preg_replace('/^\s*<\?php\s*/', '', $oldRoutes);
$oldRoutesClean = preg_replace('#/\*.*?\*/#s', '', $oldRoutesClean); // Borra comentarios multilínea
$oldRoutesClean = preg_replace('#//.*#', '', $oldRoutesClean); // Borra comentarios línea
$oldRoutesClean = trim($oldRoutesClean);

// Ahora fusionamos

$fusedRoutes = "<?php\n\n" . trim($before) . "\n\n" . $oldRoutesClean . "\n\n" . $after;

// Guardamos el resultado en web.php
file_put_contents(__DIR__ . '/web.php', $fusedRoutes);

echo "Rutas fusionadas correctamente en routes/web.php\n";

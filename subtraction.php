<?php if (isset($_POST["files-columns"]) && isset($_POST["checker"])) {
    for ($i = 1; $i < $_POST["files-columns"] + 1; $i++) {
        for ($j = 1; $j < $_POST["files-columns"] + 1; $j++) {
            echo $_POST["a" . $i . $j] + (-1 * $_POST["b" . $i . $j]);
        }
        echo "<br>";
    }
    die();
} ?>

<!doctype html>
<html lang="es">
<head>
    <? require_once("includes/head_tags.php"); ?>
    <title>Resta de Matrices - juandavid.dev</title>
</head>
<body>
<div class="container">
    <h1>Resta de Matrices</h1>
    <form method="post">
        <div class="form-group">
            <label for="files-columns">Filas y Columnas</label>
            <input id="files-columns" name="files-columns" type="number" class="form-control"
                   value="<? if (isset($_POST['files-columns'])) {
                       echo $_POST['files-columns'];
                   } ?>">
        </div>
        <div id="matrix-a">
            <? if (isset($_POST["files-columns"])) : ?>
                <? for ($i = 1; $i < $_POST["files-columns"] + 1; $i++) : ?>
                    <div class="form-row mb-2">
                        <? for ($j = 1; $j < $_POST["files-columns"] + 1; $j++) : ?>
                            <input type="hidden" name="checker" value="1">
                            <div class="col">
                                <input name="a<? echo $i . $j ?>" type="number" class="form-control"
                                       placeholder="a<? echo $i . $j ?>" required>
                            </div>
                        <? endfor; ?>
                    </div>
                <? endfor; ?>
            <? endif; ?>
        </div>
        <div id="matrix-b">
            <? if (isset($_POST["files-columns"])) : ?>
                <? for ($i = 1; $i < $_POST["files-columns"] + 1; $i++) : ?>
                    <div class="form-row mb-2">
                        <? for ($j = 1; $j < $_POST["files-columns"] + 1; $j++) : ?>
                            <input type="hidden" name="checker" value="1">
                            <div class="col">
                                <input name="b<? echo $i . $j ?>" type="number" class="form-control"
                                       placeholder="b<? echo $i . $j ?>" required>
                            </div>
                        <? endfor; ?>
                    </div>
                <? endfor; ?>
            <? endif; ?>
        </div>
        <div class="form-group mb-5">
            <button type="submit" class="btn btn-primary">Siguiente</button>
        </div>
    </form>
    <a class="btn btn-outline-primary" href="">Borrar</a>
</div>
</body>
</html>

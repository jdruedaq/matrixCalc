<?php if (isset($_POST["files"]) && isset($_POST["columns"]) && isset($_POST["checker"])) {
    echo "<table>";
    for ($j = 1; $j < $_POST["columns"] + 1; $j++) {
        echo "<tr>";
        for ($i = 1; $i < $_POST["files"] + 1; $i++) {
            echo "<td style='text-align: right'>";
            echo $_POST["a" . $i . $j] . " ";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    die();
} ?>

<!doctype html>
<html lang="es">
<head>
    <? require_once("includes/head_tags.php"); ?>
    <title>Transponer Matriz - juandavid.dev</title>
</head>
<body>
<div class="container">
    <h1>Transponer Matriz</h1>
    <form method="post">
        <div class="form-group">
            <label for="files">Filas</label>
            <input id="files" name="files" type="number" class="form-control" value="<? if (isset($_POST['files'])) {
                echo $_POST['files'];
            } ?>">
        </div>
        <div class="form-group">
            <label for="columns">Columnas</label>
            <input id="columns" name="columns" type="number" class="form-control"
                   value="<? if (isset($_POST['columns'])) {
                       echo $_POST['columns'];
                   } ?>">
        </div>
        <div id="matrix">
            <? if (isset($_POST["files"]) && isset($_POST["columns"])) : ?>
                <? for ($i = 1; $i < $_POST["files"] + 1; $i++) : ?>
                    <div class="form-row mb-2">
                        <? for ($j = 1; $j < $_POST["columns"] + 1; $j++) : ?>
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
        <div class="form-group mb-5">
            <button type="submit" class="btn btn-primary">Siguiente</button>
        </div>
    </form>
    <a class="btn btn-outline-primary" href="">Borrar</a>
</div>
</body>
</html>

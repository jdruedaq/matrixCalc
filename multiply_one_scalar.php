<?php if (isset($_POST["files"]) && isset($_POST["columns"]) && isset($_POST["x"]) && isset($_POST["checker"])) {
    echo "<div class='grid-wrapper'>";
    for ($i = 1; $i < $_POST["files"] + 1; $i++) {
        for ($j = 1; $j < $_POST["columns"] + 1; $j++) {
            echo "<div class='grid-layout'>
                    <div class='organize'>";
            echo $_POST["x"] * $_POST["a" . $i . $j];
            echo "</div></div>";
        }
    }
    echo "</div>";

    echo "<style>
                .grid-wrapper {
                    display: grid;
                    grid-template-columns: repeat(" . $_POST["columns"] . ", 4vw); 
                    grid-gap: 5px;
                }
           </style>";
    die();
}
?>

<!doctype html>
<html lang="es">
<head>
    <? include_once("includes/head_tags.php"); ?>
    <title>Multiplicación de Matrices - juandavid.dev</title>
</head>
<body>
<div class="container">
    <h1>Multiplicación por un escaar</h1>
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
        <div class="col-auto">
            <label class="sr-only" for="inlineFormInputGroup">Username</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">X=</div>
                </div>
                <input type="text" class="form-control" id="x" name="x" value="<? if (isset($_POST['x'])) {
                    echo $_POST['x'];
                } ?>">
            </div>
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

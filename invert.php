<?php
require_once "includes/Fraction.php";

if (isset($_POST["size"]) && isset($_POST["checker"])) {
    echo "<div class='grid-wrapper'>";

    $file = 0;
    $column = 0;
    $steep = 0;
    $determinante = 0;

    // Izquierda Derecha
    while ($steep != $_POST["size"]) {
        $multiply = 1;
        for ($j = 1; $j < $_POST["size"] + 1; $j++) {               // Columna
            $column = $j;
            if ($file >= $_POST["size"] && $column == 1) {
                $file = $steep;
            } else if ($file >= $_POST["size"]) {
                $file = 0;
            }
            $file++;
            $multiply = $_POST["a" . $file . $j] * $multiply;
        }
        $steep++;
        $file = 3;
        $determinante += $multiply;
    }

    $file = 0;
    $column = 0;
    $steep = 0;


    // Derecha Izquierda
    while ($steep != $_POST["size"]) {
        $multiply = 1;
        for ($j = $_POST["size"]; $j >= 1; $j--) {               // Columna
            $column = $j;
            if ($file >= $_POST["size"] && ($column == 2 || $column == 1)) {
                $file = 0;
            } else if ($file >= $_POST["size"]) {
                $file = $steep;
            }
            $file++;
            $multiply = $_POST["a" . $file . $j] * $multiply;
        }
        $steep++;
        $file = 3;
        $determinante -= $multiply;
    }

    for ($j = 1; $j < $_POST["size"] + 1; $j++) {
        for ($i = 1; $i < $_POST["size"] + 1; $i++) {
            echo "<div class='grid-layout'>
                    <div class='organize'>";

            $fil = $i;
            $col = $j;
            echo "<script>console.log('" . "a" . $i . $j . "')</script>";
            echo "<script>console.log('==================================================================')</script>";
            $position = ["1" => 0, "2" => 0, "3" => 0, "4" => 0];
            $contador = 0;
            for ($k = 1; $k < $_POST["size"] + 1; $k++) {
                for ($l = 1; $l < $_POST["size"] + 1; $l++) {
                    if ($fil != $k && $col != $l) {
                        $contador++;
                        $position[$contador] = $_POST["a" . $k . $l];
                    }
                }
            }
            $_POST["b" . $i . $j] = pow(-1, $i + $j) * ($position["1"] * $position["4"] - $position["2"] * $position["3"]);
            echo "<script>console.log('a$i$j = -1^$i + $j * " . $position["1"] . " * " . $position["4"] . " - " . $position["2"] . " * " . $position["3"] . "')</script>";
            echo "<script>console.log('------------------------------------------------------------------')</script>";
            if ($determinante != 0) {
                $f = new Math_Fraction($_POST["b" . $i . $j], $determinante);
                echo $f->toString();
            }
            echo "</div></div>";
        }
    }

    echo "</div>";

    echo "<style>
                .grid-wrapper {
                    display: grid;
                    grid-template-columns: repeat(" . $_POST["size"] . ", 4vw); 
                    grid-gap: 5px;
                }
           </style>";
    echo "<br>|A| = " . $determinante;
    die();
} ?>

<!doctype html>
<html lang="es">
<head>
    <? require_once("includes/head_tags.php"); ?>
    <title>Matriz Inversa - juandavid.dev</title>
</head>
<body>
<div class="container">
    <h1>Matriz Inversa</h1>
    <form method="post">
        <div class="form-group">
            <label for="files">Filas y Columnas</label>
            <input id="files" name="size" type="number" class="form-control" value="<? if (isset($_POST['size'])) {
                echo $_POST['size'];
            } ?>">
        </div>
        <div id="matrix">
            <? if (isset($_POST["size"])) : ?>
                <? for ($i = 1; $i < $_POST["size"] + 1; $i++) : ?>
                    <div class="form-row mb-2">
                        <? for ($j = 1; $j < $_POST["size"] + 1; $j++) : ?>
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
<?php
if (isset($_POST["files-columns"]) && isset($_POST["checker"])) {
    //echo "<pre>" . json_encode($_POST, JSON_PRETTY_PRINT) . "</pre>";

    echo "<div class='grid-wrapper'>";

    for ($i = 1; $i < $_POST["files-columns"] + 1; $i++) {
        //echo "<script>console.log('" . $_POST["a$i$i"] . "')</script>";   // Pivot
        $pivot = $_POST["a$i$i"];
        for ($j = $i; $j < $_POST["files-columns"] + 1; $j++) {
            if ($pivot != 0) {
                $_POST["a$i$j"] = $_POST["a$i$j"] / $pivot;
            }
        }

        if ($pivot != 0) {
            $_POST["r$i"] = $_POST["r$i"] / $pivot;
        }

        for ($k = $i + 1; $k < $_POST["files-columns"] + 1; $k++) {
            $invert = $_POST["a" . $k . $i] * -1;
            for ($j = $i; $j < $_POST["files-columns"] + 1; $j++) {
                $line = $k;
                $_POST["a$line$j"] = $invert * $_POST["a$i$j"] + $_POST["a$line$j"];
            }
            $_POST["r$line"] = $invert * $_POST["r$i"] + $_POST["r$line"];
        }
    }

    // verification
    $infinite = false;
    $checker = 0;
    for ($i = 1; $i < $_POST["files-columns"] + 1; $i++) {
        $checker = $_POST["a$i$i"];
    }

    if ($checker == 0) {
        echo "<script>alert('El sistema tiene infinitas soluciones')</script>";
        $infinite = true;
    }

    // Second part
    if (!$infinite) { // if not is infinite
        for ($i = 1; $i < $_POST["files-columns"] + 1; $i++) {
            for ($k = $i + 1; $k < $_POST["files-columns"] + 1; $k++) {
                    $invert = $_POST["a$i$k"] * -1;
                echo "<script>console.log('desinvert = a$i$k = " . $_POST["a$i$k"] . "')</script>";
                echo "<script>console.log('invert = a$i$k = " . $invert . "')</script>";
                for ($j = $k; $j < $_POST["files-columns"] + 1; $j++) {
                    echo "<script>console.log('a$i$j = " . $invert . " * " . $_POST["a$k$j"] . " + " . $_POST["a$i$j"] . "')</script>";
                    echo "<script>console.log('a$i$j = " . $invert . " * " . "a$k$j" . " + " . "a$i$j" . "')</script>";
                    $_POST["a$i$j"] = $invert * $_POST["a$k$j"] + $_POST["a$i$j"];
                    echo "<script>console.log(' = " . $_POST["a$i$j"] . "')</script>";
                }
                echo "<script>console.log('- - - - - - - - - - - - - -')</script>";
                echo "<script>console.log('a$i$k = " . ($invert * -1) . "')</script>";
                echo "<script>console.log('$invert')</script>";
                echo "<script>console.log('r$i = " . $invert . " * " . $_POST["r" . ($i + 1)] . " + " . $_POST["r$i"] . "')</script>";
                echo "<script>console.log('r$i = " . $invert . " * " . "r" . ($i + 1) . " + " . "r$i" . "')</script>";
                echo "<script>console.log('" . ($invert * $_POST["r" . ($i + 1)] + $_POST["r$i"]) . "')</script>";
                echo "<script>console.log('<<<<<<<<<<<<<----------------------------<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>')</script>";
                $_POST["r$i"] = $invert * $_POST["r" . ($i + 1)] + $_POST["r$i"];
            }
        }
    }

    for ($i = 1; $i < $_POST["files-columns"] + 1; $i++) {
        for ($j = 1; $j < $_POST["files-columns"] + 1; $j++) {
            echo "<div class='grid-layout'>
                    <div class='organize'>";
            echo round($_POST["a$i$j"], 2);
            echo "</div></div>";
        }
        echo "| " . round($_POST["r$i"], 2);
    }
    echo "</div>";

    echo "<style>
                .grid-wrapper {
                    display: grid;
                    grid-template-columns: repeat(" . ($_POST["files-columns"] + 1) . ", 4vw); 
                    grid-gap: 5px;
                }
           </style>";
    die();
} ?>

<!doctype html>
<html lang="es">
<head>
    <? require_once("includes/head_tags.php"); ?>
    <title>Resolución de Matrices - juandavid.dev</title>
</head>
<body>
<div class="container">
    <h1>Resolución de Matrices</h1>
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
                                       placeholder="x<? echo $j ?>" required>
                            </div>
                        <? endfor; ?>
                        =
                        <div class="col">
                            <input name="r<? echo $i ?>" type="number" class="form-control"
                                   placeholder="r<? echo $i ?>" required>
                        </div>
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

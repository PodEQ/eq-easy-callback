<?php
/**
 * READ: JSON Calls
 */
function array_multi_search($mSearch, $aArray, $sKey = "")
{
    $aResult = array();

    foreach ((array)$aArray as $aValues) {
        if ($sKey === "" && in_array($mSearch, $aValues)) $aResult[] = $aValues;
        else
            if (isset($aValues[$sKey]) && $aValues[$sKey] == $mSearch) $aResult[] = $aValues;
    }

    return $aResult;
}

//------------------------------------------- JSON: Contributors ---------------------------------------------------

/**
 * Read: Contributors (JSON)
 */
$main->route('GET|POST /sysop/json/portal/@portal/contributors', function ($main, $params) {
    header('Content-type: application/json; charset=UTF-8');
    $suche = @$_POST["search"];
    $ordner = 'ext/' . $params["portal"] . 'Contri/data';
    $alledateien = scandir($ordner); // Sortierung Z-A mit scandir($ordner, 1)
    $test = array();
    foreach ($alledateien as $datei) {
        $episoden = pathinfo($ordner . "/" . $datei);
        if ($datei != "." && $datei != ".." && $datei != ".DS_Store") {
            $pos = stripos($episoden["filename"], $suche);
            if ($pos !== false) {
                $test[]["value"] = preg_replace("/(-)+/", " ", $episoden["filename"]);
            }
        }
    }
    echo json_encode($test);
});


/**
 * JSON: Mitwirkende, Gäste
 */
$main->route('GET|POST /sysop/json/portal/guest/contributors', function ($main, $params) {
    header('Content-type: application/json; charset=UTF-8');
    $suche = @$_POST["search"];
    $ordner = 'ext/contributors/data';
    $alledateien = scandir($ordner); // Sortierung Z-A mit scandir($ordner, 1)
    $test = array();
    foreach ($alledateien as $datei) {
        $episoden = pathinfo($ordner . "/" . $datei);
        if ($datei != "." && $datei != ".." && $datei != ".DS_Store") {
            $pos = stripos($episoden["filename"], $suche);
            if ($pos !== false) {
                $test[]["value"] = preg_replace("/(-)+/", " ", $episoden["filename"]);
            }
        }
    }
    echo json_encode($test);
});

?>
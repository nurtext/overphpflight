<?php
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER['REQUEST_URI'])) {
    // Return resources directly
    return false;
} else { 
    $objs = [];

    // Iterate over img directory
    foreach (\glob('img/*.{png,jpg,jpeg,gif}', \GLOB_BRACE) as $filename) {
        // Check if file is readable
        if (\is_readable($filename)) {
            // Create a new object
            $obj = new \stdClass();
            $obj->title    = basename($filename);
            $obj->location = 'overphplight';
            $obj->url_img  = \sprintf('http://%1$s/%2$s', $_SERVER['HTTP_HOST'], $filename);
        }

        // Add obj to array
        if ($obj) $objs[] = $obj;
    }

    // Set correct header end output all objects as json
    header('Content-Type: application/json');
    echo \json_encode($objs, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES);
}
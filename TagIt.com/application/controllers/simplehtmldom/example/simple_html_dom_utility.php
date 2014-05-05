<?php
include_once('../simple_html_dom.php');

function html_no_comment($url) {
    // create HTML DOM
    $html = file_get_html($url);

    // remove all comment elements
    foreach($html->find('comment') as $e)
        $e->outertext = '';

    $ret = $html->save();

    // clean up memory
    $html->clear();
    unset($html);

    return $ret;
}

// -----------------------------------------------------------------------------
function find_contains($html, $selector, $keyword, $index=-1) {
    $ret = array();
    foreach ($html->find($selector) as $e) {
        if (strpos($e->innertext, $keyword)!==false)
            $ret[] = $e;
    }

    if ($index<0) return $ret;
    return (isset($ret[$index])) ? $ret[$index] : null;
}
?>
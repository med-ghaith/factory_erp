<?php
function base_url($path = '') {
    $root = $_SERVER['SCRIPT_NAME'];
    $base = str_replace(basename($root), '', $root);
    return rtrim($base, '/') . '/' . ltrim($path, '/');
}

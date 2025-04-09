<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_slug')) {
    function generate_slug($string)
    {
        $slug = strtolower(trim($string));
        $slug = preg_replace('/[^a-z0-9]+/i', '_', $slug); 
        $slug = preg_replace('/_+/', '_', $slug);          
        return trim($slug, '_');                           
    }
}

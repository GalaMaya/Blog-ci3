<?php

function json_response($data, $status_code = 200)
{
    $CI =& get_instance();
    $CI->output
        ->set_status_header($status_code)
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
}

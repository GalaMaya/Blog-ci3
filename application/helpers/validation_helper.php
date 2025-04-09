<?php
if (!function_exists('validation_errors_array')) {
    function validation_errors_array() {
        $errors = [];

        // Ambil semua error sebagai string
        $error_string = validation_errors("\n");

        // Pisahkan berdasarkan newline
        $error_lines = explode("\n", trim($error_string));

        foreach ($error_lines as $error) {
            if (!empty($error)) {
                $errors[] = strip_tags($error);
            }
        }

        return $errors;
    }
}


<?php

if (!function_exists('content')) {
    /**
     * Helper para obter conteúdo da página
     */
    function content($contents, $section, $key, $default = '')
    {
        if (isset($contents[$section])) {
            foreach ($contents[$section] as $item) {
                if ($item->key === $key) {
                    return $item->value;
                }
            }
        }
        return $default;
    }
}

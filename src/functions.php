<?php

if(!function_exists('rubixai_getconfig')) {
    //this overwrite the global function from the package
    function rubixai_getconfig(string $config_entry = null)
    {
        if ($config_entry) {
            return config('rubixai')[$config_entry];
        }
        return config('rubixai');
    }
}

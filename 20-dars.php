<?php
// Mavzu: Autoloaded Classes
spl_autoload_register(function ($className) {
    $filename = str_replace('\\', '/', $className) . '.php';
    require $filename;
});
// Bu orqali loyihani qaysi qismidan klass olib kelinsa o'sha yerni dan require olib kelinadi.
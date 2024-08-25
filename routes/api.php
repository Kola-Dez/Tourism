<?php

$apiFiles = [
    'destination.php',
    'categories.php',
    'travel.php',
    'tours.php',
    'blog.php',
    'gallery.php',
    'transport.php',
    'findAdventure.php',
];

foreach ($apiFiles as $file) {
    require_once("api/{$file}");
}

<?php

$apiFiles = [
    'destination.php',
    'category.php',
    'travel.php',
    'tours.php',
    'blog.php',
    'gallery.php',
    'findAdventure.php',
];

foreach ($apiFiles as $file) {
    require_once("api/{$file}");
}

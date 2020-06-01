<?php

require_once __DIR__ . '/path.php';

$services = [
    'User.php',
    'UserIngredient.php',
    'Ingredient.php',
    'RecipeIngredient.php',
    'Recipe.php',
    'Step.php'
];

function require_multi(array $files)
{
    foreach ($files as $file)
        require_once(SERVICES_PATH . $file);
}

//include all services
require_multi($services);

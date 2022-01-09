<?php
namespace Website\Core;

abstract class AbstractController
{
    // Renders the page
    protected function render($page, $parameter)
    {
        extract($parameter);
        include __DIR__."/../../pages/{$page}.php";
    }
}
?>
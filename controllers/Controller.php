<?php

class Controller
{
    protected static function view($page)
    {
        require $page;
    }
}

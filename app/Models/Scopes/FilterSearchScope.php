<?php
namespace App\Models\Scopes;

trait FilterSearchScope
{
    public static function bootFilterSearchScope()
    {
        static::addGlobalScope(new FilterScope);
        static::addGlobalScope(new SearchScope);
    }
}
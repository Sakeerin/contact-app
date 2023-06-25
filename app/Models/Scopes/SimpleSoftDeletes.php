<?php

namespace App\Models\Scopes;

trait SimpleSoftDeletes
{
    protected static function bootSimpleSoftDeletes()
    {
        static::addGlobalScope(new SimpleSoftDeletingScope);
        // static::addGlobalScope('softDeletes', function(Builder $builder){
        //     $builder->whereNull('deleted_at');
        // });
    }
}
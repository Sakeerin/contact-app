<?php

namespace App\Models;

use App\Models\Scopes\AllowedFilterSearch;
use App\Models\Scopes\AllowedSort;
use App\Models\Scopes\SimpleSoftDeletes;
use App\Models\Scopes\SimpleSoftDeletingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Contact extends Model
{
    use HasFactory, SoftDeletes, AllowedFilterSearch, AllowedSort;
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'company_id'];
    // protected $quarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
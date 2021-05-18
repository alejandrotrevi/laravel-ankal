<?php


namespace Alejandrotrevi\LaravelAnkal\Models;

use Alejandrotrevi\LaravelAnkal\HasStatuses;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use HasStatuses;

    protected $guarded = [];
}
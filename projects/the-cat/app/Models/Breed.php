<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "code",
        "name",
        "url_image",
        "origin",
        "weight_metric",
        "life_span",
        "description",
        "wikipedia_url",
    ];


    public static function checkIfExists($name)
    {
        $busca = Breed::where('name', '=', $name)->get();

        if (count($busca) > 0) {
            return true;
        }

        return false;
    }

    public static function searchByName($name)
    {
        $busca = Breed::where('name', 'LIKE', '%' . $name . '%')->get();

        return $busca;
    }
}

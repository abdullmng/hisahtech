<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'seeds',
        'model',
        'field_type'
    ];

    public function title(): Attribute
    {
        return Attribute::make(get: fn ($val, $attr) => str_replace('_', ' ', $attr['name']));
    }

    public function data(): Attribute
    {
        return Attribute::make(get: function ($val, $attr) {
            if (!is_null($attr['seeds']))
            {
                $array = explode(',', $attr['seed']);
                foreach ($array as $index => &$value)
                {
                    $array[$index] = ['id' => $value, 'name' => $value];
                }
                return $array;
            }
            elseif (!is_null($attr['model']))
            {
                return $attr['model']::all();
            }
            else
            {
                return [];
            }
        });
    }
}

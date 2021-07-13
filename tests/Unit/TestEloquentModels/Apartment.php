<?php

namespace Torian257x\RubixAi\Tests\Unit\TestEloquentModels;

use Illuminate\Database\Eloquent\Model;
use Rubix\ML\Extractors\CSV;
use Sushi\Sushi;

class Apartment extends Model
{
    use Sushi;

    protected $casts = [
        'id' => 'float',
        'price_millions' => 'float',
        'space' => 'int',
        'rooms' => 'int',
        'zone_id' => 'string',
        'zone_2_id' => 'string',
        'geo_lat' => 'float',
        'geo_lng' => 'float',
        'parking' => 'int',
        'water_heating' => 'string',
        'doorman' => 'string',
        'price_level' => 'int',
        'gas_network' => 'string',
        'balcony' => 'int',
        'linen_room' => 'int',
    ];

    public function getRows()
    {
        $data = new CSV(__DIR__ .'/csv/apartments_1k.csv', true);
        $rows = iterator_to_array($data);
        return $rows;
    }
}

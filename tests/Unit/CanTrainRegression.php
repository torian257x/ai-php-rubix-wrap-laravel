<?php


namespace Torian257x\RubixAi\Tests\Unit;


use Illuminate\Contracts\Support\Arrayable;
use Orchestra\Testbench\TestCase;
use Torian257x\RubixAi\Facades\RubixAi;
use Torian257x\RubixAi\RubixAiService;
use Torian257x\RubixAi\RubixAiServiceProvider;
use Torian257x\RubixAi\Tests\Unit\TestEloquentModels\Apartment;
use Torian257x\RubixAi\Tests\Unit\TestEloquentModels\IrisFlower;

class CanTrainRegression extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [RubixAiServiceProvider::class];
    }


    public function testCanTrainApartments(){

        $apartments = Apartment::where('space', '<', 200)->get();

        $report = RubixAi::train($apartments, 'price_millions', train_part_size: 0.95);

        self::assertLessThan(0.4, $report['mean absolute error']);
    }


}

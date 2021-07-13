<?php


namespace Torian257x\RubixAi\Tests\Unit;


use Illuminate\Contracts\Support\Arrayable;
use Orchestra\Testbench\TestCase;
use Torian257x\RubixAi\Facades\RubixAi;
use Torian257x\RubixAi\RubixAiService;
use Torian257x\RubixAi\RubixAiServiceProvider;
use Torian257x\RubixAi\Tests\Unit\TestEloquentModels\Apartment;
use Torian257x\RubixAi\Tests\Unit\TestEloquentModels\IrisFlower;

class CanTrainIrisTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [RubixAiServiceProvider::class];
    }

    public function testCanTrainIris()
    {
        $flowers = IrisFlower::all();

        $report = RubixAi::train($flowers, 'iris_plant_type');

        self::assertGreaterThan(0.9, $report['fbeta']);
    }

}

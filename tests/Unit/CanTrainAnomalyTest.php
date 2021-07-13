<?php


namespace Torian257x\RubixAi\Tests\Unit;


use Illuminate\Contracts\Support\Arrayable;
use Orchestra\Testbench\TestCase;
use Rubix\ML\AnomalyDetectors\GaussianMLE;
use Torian257x\RubixAi\Facades\RubixAi;
use Torian257x\RubixAi\RubixAiService;
use Torian257x\RubixAi\RubixAiServiceProvider;
use Torian257x\RubixAi\Tests\Unit\TestEloquentModels\Apartment;
use Torian257x\RubixAi\Tests\Unit\TestEloquentModels\IrisFlower;

class CanTrainAnomalyTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [RubixAiServiceProvider::class];
    }


    public function testCanTrainApartments(){

        $apartments = Apartment::where('space', '<', 200)->get();

        $apartments = $apartments->map(function($a){

            if($a->water_heating === 'No tiene'){
                $a->water_heating = 0;
            }else if($a->water_heating === 'Gas'){
                $a->water_heating = 1;
            }else if($a->water_heating === 'Eléctrico'){
                $a->water_heating = 0.5;
            }else{
                $a->water_heating = 0;
            }

            if($a->doorman === '24 Horas'){
                $a->doorman = 1;
            }else if($a->doorman === 'Diurna'){
                $a->doorman = 0.5;
            }else if($a->doorman === 'No tiene'){
                $a->doorman = 0;
            }else{
                $a->doorman = 0;
            }

            return $a;

        });

        $apartments->makeHidden(['zone_2_id', 'zone_id']);

        $data = RubixAi::trainWithoutTest($apartments, estimator_algorithm: new GaussianMLE(contamination: 0.005));



        RubixAi::toCsv($data, 'cluster_out.csv');
    }


}

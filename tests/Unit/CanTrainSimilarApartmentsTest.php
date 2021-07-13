<?php


namespace Torian257x\RubixAi\Tests\Unit;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Orchestra\Testbench\TestCase;
use Rubix\ML\Clusterers\KMeans;
use Rubix\ML\Extractors\ColumnPicker;
use Rubix\ML\Extractors\CSV;
use Rubix\ML\Kernels\Distance\Manhattan;
use Rubix\ML\Transformers\MissingDataImputer;
use Rubix\ML\Transformers\NumericStringConverter;
use Rubix\ML\Transformers\OneHotEncoder;
use Rubix\ML\Transformers\ZScaleStandardizer;
use Torian257x\RubixAi\Facades\RubixAi;
use Torian257x\RubixAi\RubixAiService;
use Torian257x\RubixAi\RubixAiServiceProvider;
use Torian257x\RubixAi\Tests\Unit\TestEloquentModels\Apartment;
use Torian257x\RubixAi\Tests\Unit\TestEloquentModels\IrisFlower;
use Torian257x\RubWrap\Service\RubixService;

class CanTrainSimilarApartmentsTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [RubixAiServiceProvider::class];
    }


    public static function getData()
    {

        $data = Apartment::limit(10)->get();
        $data = $data->map(
            function (Apartment $a) {

                $wh = $a->water_heating;

                if ($wh === 'No tiene') {
                    $wh_val = 0;
                } else if ($wh === 'Gas') {
                    $wh_val = 1;
                } else if ($wh === 'Eléctrico') {
                    $wh_val = 0.5;
                } else {
                    $wh_val = 0;
                }
                $a->water_heating = $wh_val;

                $dm = $a->doorman;


                if ($dm === '24 Horas') {
                    $dm_val = 1;
                } else if ($dm === 'Diurna') {
                    $dm_val = 0.5;
                } else if ($dm === 'No tiene') {
                    $dm_val = 0;
                } else {
                    $dm_val = 0;
                }

                $a->doorman = $dm_val;

                $a->rr = $a->rooms ^ 2;
                $a->pp = $a->price_millions ^ 2;
                $a->p_t_r = $a->price_millions * $a->rooms ;
                $a->p_t_lat = $a->price_millions * $a->geo_lat;
                $a->p_t_lng = $a->price_millions * $a->geo_lng;

                return $a;
            }
        );


        return $data;
    }

    public function testGetSimilar()
    {

        $data = self::getData();

        $nr_groups = ceil(sqrt(count($data) / 2));


        $data_w_cluster_nr = RubixAi::trainWithoutTest(
            $data,
            estimator_algorithm: new KMeans($nr_groups, kernel: new Manhattan()),
            transformers: [
                new MissingDataImputer(),
                new NumericStringConverter(),
                new ZScaleStandardizer(),
            ]
        );

    }

}


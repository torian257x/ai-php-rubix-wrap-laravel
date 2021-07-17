<?php


namespace Torian257x\RubixAi\Tests\Unit;


use Orchestra\Testbench\TestCase;
use Torian257x\RubixAi\RubixAiService;
use Torian257x\RubixAi\RubixAiServiceProvider;
use Torian257x\RubWrap\Service\RubixService;

class LConfigTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [RubixAiServiceProvider::class];
    }

    public function testConfigAccessWorks()
    {
        $c = config('rubixai');

        self::assertNotEmpty($c['csv_path_output']);


        $c = RubixAiService::getConfig();

        self::assertNotEmpty($c['csv_path_output']);

        self::assertNull($c['shouldNotExist'] ?? null);

        $mc = rubixai_getconfig('RubixMainClass');

        $anomalies =  array_column($mc, 'anomaly');
        self::assertGreaterThan(5,gv array_sum($anomalies));
        self::assertEquals(RubixService::class, $mc);
    }



}

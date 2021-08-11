<?php

namespace Torian257x\RubixAi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static array train($data, mixed $data_index_w_label = null, \Rubix\ML\Estimator $estimator_algorithm = null, array $transformers = null, $model_filename = 'model_trained.rbx', float $train_part_size = 0.7)
 * @method static array trainWithoutTest($data, mixed $data_index_w_label = null, \Rubix\ML\Estimator $estimator_algorithm = null, array $transformers = null, $model_filename = 'model_trained.rbx')
 * @method static array|int predict($input_data, \Rubix\ML\Estimator $estimator = null, string $model_filename = 'model_trained.rbx')
 * @method static array getErrorAnalysis($samples_w_labels, $key_for_labels, $model_filename = 'model_trained.rbx')
 * @method static array getConfig(string $config_entry = null)
 * @method static array toCsv(array $data, string $filename)
 * @method static array fromCsv(string $filename, ?array $columns = null)
 *
 * @see \Torian257x\RubixAi\RubixAiService
 */
class RubixAi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'rubixai';
    }
}

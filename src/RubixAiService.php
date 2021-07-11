<?php

namespace Torian257x\RubixAi;

use Illuminate\Support\Collection;
use Rubix\ML\Estimator;
use Torian257x\RubixAi\Exceptions\RubixAiGeneralException;
use Torian257x\RubWrap\Service\RubixService;

class RubixAiService extends RubixService
{

    public static function getConfig(string $config_entry = null)
    {
        return config('rubixai');
    }

    public static function train(
        $data,
        mixed $data_index_w_label,
        Estimator $estimator_algorithm = null,
        array $transformers = null,
        $model_filename = 'model_trained.rbx',
        float $train_part_size = 0.7
    ) {
        $data = static::mixedToArray($data);

        return parent::train(
            $data,
            $data_index_w_label,
            $estimator_algorithm,
            $transformers,
            $model_filename,
            $train_part_size
        );
    }

    public static function trainWithoutTest(
        $data,
        mixed $data_index_w_label,
        Estimator $estimator_algorithm = null,
        array $transformers = null,
        $model_filename = 'model_trained.rbx'
    ) {
        $data = static::mixedToArray($data);

        return parent::trainWithoutTest(
            $data,
            $data_index_w_label,
            $estimator_algorithm,
            $transformers,
            $model_filename
        );
    }

    public static function predict(
        $input_data,
        Estimator $estimator = null,
        string $model_filename = 'model_trained.rbx'
    ): array|int {
        $input_data = static::mixedToArray($input_data);
        return parent::predict($input_data, $estimator, $model_filename);
    }

    public static function getErrorAnalysis(
        $samples_w_labels,
        $key_for_labels,
        $model_filename = 'model_trained.rbx'
    ) {
        $samples_w_labels = static::mixedToArray($samples_w_labels);
        return parent::getErrorAnalysis(
            $samples_w_labels,
            $key_for_labels,
            $model_filename
        );
    }


    private static function mixedToArray($data){
        if(is_array($data)){
            return $data;
        }else if($data instanceof Collection){
            return $data->toArray();
        } else if ($data instanceof \iterable){
            return iterator_to_array($data);
        }else{
            throw new RubixAiGeneralException("Cannot convert this data type to array: " . get_class($data));
        }
    }
}

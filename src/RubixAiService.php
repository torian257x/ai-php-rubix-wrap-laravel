<?php

namespace Torian257x\RubixAi;

use Illuminate\Support\Collection;
use Rubix\ML\Estimator;
use Torian257x\RubixAi\Exceptions\RubixAiGeneralException;
use Torian257x\RubWrap\Service\RubixService;

class RubixAiService extends RubixService
{

    const DEFAULT_IGNORED_ATTRS = ['id', 'created_at', 'updated_at'];

    public static function getConfig(string $config_entry = null)
    {
        if($config_entry){
            return config('rubixai')[$config_entry];
        }
        return config('rubixai');
    }

    public static function train(
        $data,
        mixed $data_index_w_label = null,
        Estimator $estimator_algorithm = null,
        array $transformers = null,
        $model_filename = 'model_trained.rbx',
        float $train_part_size = 0.7,
        array $ignored_attributes = self::DEFAULT_IGNORED_ATTRS
    ) {
        $data = static::mixedToArray($data, $ignored_attributes);

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
        mixed $data_index_w_label = null,
        Estimator $estimator_algorithm = null,
        array $transformers = null,
        $model_filename = 'model_trained.rbx',
        array $ignored_attributes = self::DEFAULT_IGNORED_ATTRS
    ) {
        $data = static::mixedToArray($data, $ignored_attributes);

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
        string $model_filename = 'model_trained.rbx',
        array $ignored_attributes = self::DEFAULT_IGNORED_ATTRS
    ): array|int {
        $input_data = static::mixedToArray($input_data, $ignored_attributes);
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


    private static function mixedToArray($data, array $ignore_attrs = null){
        if(is_array($data)){
            $rv = $data;
        }else if($data instanceof Collection){
            $rv = $data->toArray();
        } else if ($data instanceof \iterable){
            $rv = iterator_to_array($data);
        }else{
            throw new RubixAiGeneralException("Cannot convert this data type to array: " . get_class($data));
        }

        if(!is_null($ignore_attrs)){
            foreach($rv as &$v){
                foreach($ignore_attrs as $i){
                    unset($v[$i]);
                }
            }
        }

        return $rv;
    }
}

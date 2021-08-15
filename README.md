# torian257x/ai-php-rubix-wrap-laravel
This is about Artificial Intelligence, Machine Learning and Pattern Recognition.

This library is using a [PHP standalone AI wrapper](https://github.com/torian257x/ai-php-rubix-wrap) of [Rubix ML](https://github.com/RubixML/ML)

Do AI with 2 lines of code:

```
$all_animals = DogsAndCats::all();

$report = RubixAi::train($all_animals, 'dog_or_cat');
```

that's it.

This creates a file in your laravel storage/ai_rubix/ folder that contains the model.

This model then will be used to predict:

```
$isDogOrCat = RubixAi::predict($needs_prediction);

echo $isDogOrCat; //prints ['dog']
```

## Installation

```
composer require torian257x/ai-php-rubix-wrap-laravel
```

If there are any issues, please have a look at https://docs.rubixml.com/latest/installation.html in case you are trying to do something special that requires say, tensor.

## Default Estimator
`new KDNeighborsRegressor()` for regression (say estimation of price)
      
`new KDNeighbors()` for classification (say choose dog or cat)

## Default Transformers
```
array_filter(
 [
  new NumericStringConverter(),
  new MissingDataImputer(),
  $needs_ohe ? new OneHotEncoder() : false,
  new MinMaxNormalizer(),
 ]);
```

## Customize 
You can [choose your own estimator](https://docs.rubixml.com/latest/choosing-an-estimator.html) if you don't like the default
Just be sure to pass it as argument to `RubixAi::train(..., estimator_algorithm:<>)`

Same for transformers.

You can customize the model file name as well as what attributes / columns to ignore.



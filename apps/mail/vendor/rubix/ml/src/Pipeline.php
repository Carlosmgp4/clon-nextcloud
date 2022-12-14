<?php

namespace Rubix\ML;

use Rubix\ML\Datasets\Dataset;
use Rubix\ML\Transformers\Elastic;
use Rubix\ML\Other\Helpers\Params;
use Rubix\ML\Transformers\Stateful;
use Rubix\ML\Transformers\Transformer;
use Rubix\ML\Other\Traits\ProbaSingle;
use Rubix\ML\Other\Traits\LoggerAware;
use Rubix\ML\AnomalyDetectors\Scoring;
use Rubix\ML\Other\Traits\RanksSingle;
use Rubix\ML\Other\Traits\PredictsSingle;
use Rubix\ML\Other\Traits\AutotrackRevisions;
use Rubix\ML\Exceptions\InvalidArgumentException;
use Rubix\ML\Exceptions\RuntimeException;
use Psr\Log\LoggerInterface;

/**
 * Pipeline
 *
 * Pipeline is a meta-estimator capable of transforming an input dataset by applying a
 * series of Transformer *middleware*. Under the hood, Pipeline will automatically fit the
 * training set and transform any Dataset object supplied as an argument to one of the base
 * estimator's methods before hitting the method context. With *elastic* mode enabled,
 * Pipeline will update the fitting of Elastic transformers during partial training.
 *
 * @category    Machine Learning
 * @package     Rubix/ML
 * @author      Andrew DalPino
 */
class Pipeline implements Online, Wrapper, Probabilistic, Scoring, Ranking, Verbose, Persistable
{
    use AutotrackRevisions, PredictsSingle, ProbaSingle, RanksSingle, LoggerAware;

    /**
     * A list of transformers to be applied in series.
     *
     * @var list<\Rubix\ML\Transformers\Transformer>
     */
    protected $transformers = [
        //
    ];

    /**
     * An instance of a base estimator to receive the transformed data.
     *
     * @var \Rubix\ML\Estimator
     */
    protected $base;

    /**
     * Should we update the elastic transformers during partial train?
     *
     * @var bool
     */
    protected $elastic;

    /**
     * The PSR-3 logger instance.
     *
     * @var \Psr\Log\LoggerInterface|null
     */
    protected $logger;

    /**
     * @param \Rubix\ML\Transformers\Transformer[] $transformers
     * @param \Rubix\ML\Estimator $base
     * @param bool $elastic
     * @throws \Rubix\ML\Exceptions\InvalidArgumentException
     */
    public function __construct(array $transformers, Estimator $base, bool $elastic = true)
    {
        foreach ($transformers as $transformer) {
            if (!$transformer instanceof Transformer) {
                throw new InvalidArgumentException('Transformer must'
                    . ' implement the Transformer interface.');
            }
        }

        $this->transformers = array_values($transformers);
        $this->base = $base;
        $this->elastic = $elastic;
    }

    /**
     * Return the estimator type.
     *
     * @internal
     *
     * @return \Rubix\ML\EstimatorType
     */
    public function type() : EstimatorType
    {
        return $this->base->type();
    }

    /**
     * Return the data types that the estimator is compatible with.
     *
     * @internal
     *
     * @return list<\Rubix\ML\DataType>
     */
    public function compatibility() : array
    {
        return $this->base->compatibility();
    }

    /**
     * Return the settings of the hyper-parameters in an associative array.
     *
     * @internal
     *
     * @return mixed[]
     */
    public function params() : array
    {
        return [
            'transformers' => $this->transformers,
            'estimator' => $this->base,
            'elastic' => $this->elastic,
        ];
    }

    /**
     * Sets a logger instance on the object.
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger) : void
    {
        if ($this->base instanceof Verbose) {
            $this->base->setLogger($logger);
        }

        $this->logger = $logger;
    }

    /**
     * Has the learner been trained?
     *
     * @return bool
     */
    public function trained() : bool
    {
        return $this->base instanceof Learner
            ? $this->base->trained()
            : true;
    }

    /**
     * Return the base estimator instance.
     *
     * @return \Rubix\ML\Estimator
     */
    public function base() : Estimator
    {
        return $this->base;
    }

    /**
     * Run the training dataset through all transformers in order and use the
     * transformed dataset to train the estimator.
     *
     * @param \Rubix\ML\Datasets\Dataset $dataset
     */
    public function train(Dataset $dataset) : void
    {
        foreach ($this->transformers as $transformer) {
            if ($transformer instanceof Stateful) {
                $transformer->fit($dataset);

                if ($this->logger) {
                    $this->logger->info("Fitted $transformer");
                }
            }

            $dataset->apply($transformer);
        }

        if ($this->base instanceof Learner) {
            $this->base->train($dataset);
        }
    }

    /**
     * Perform a partial train.
     *
     * @param \Rubix\ML\Datasets\Dataset $dataset
     */
    public function partial(Dataset $dataset) : void
    {
        if ($this->elastic) {
            foreach ($this->transformers as $transformer) {
                if ($transformer instanceof Elastic) {
                    $transformer->update($dataset);

                    if ($this->logger) {
                        $this->logger->info("Updated $transformer");
                    }
                }

                $dataset->apply($transformer);
            }
        } else {
            $this->preprocess($dataset);
        }

        if ($this->base instanceof Online) {
            $this->base->partial($dataset);
        }
    }

    /**
     * Preprocess the dataset and return predictions from the estimator.
     *
     * @param \Rubix\ML\Datasets\Dataset $dataset
     * @return mixed[]
     */
    public function predict(Dataset $dataset) : array
    {
        $this->preprocess($dataset);

        return $this->base->predict($dataset);
    }

    /**
     * Estimate the joint probabilities for each possible outcome.
     *
     * @param \Rubix\ML\Datasets\Dataset $dataset
     * @throws \Rubix\ML\Exceptions\RuntimeException
     * @return array[]
     */
    public function proba(Dataset $dataset) : array
    {
        $this->preprocess($dataset);

        if (!$this->base instanceof Probabilistic) {
            throw new RuntimeException('Base Estimator must'
                . ' implement the Probabilistic interface.');
        }

        return $this->base->proba($dataset);
    }

    /**
     * Return the anomaly scores assigned to the samples in a dataset.
     *
     * @param \Rubix\ML\Datasets\Dataset $dataset
     * @throws \Rubix\ML\Exceptions\RuntimeException
     * @return float[]
     */
    public function score(Dataset $dataset) : array
    {
        $this->preprocess($dataset);

        if (!$this->base instanceof Scoring) {
            throw new RuntimeException('Base Estimator must'
                . ' implement the Ranking interface.');
        }

        return $this->base->score($dataset);
    }

    /**
     * Return the anomaly scores assigned to the samples in a dataset.
     *
     * @deprecated
     *
     * @param \Rubix\ML\Datasets\Dataset $dataset
     * @return float[]
     */
    public function rank(Dataset $dataset) : array
    {
        warn_deprecated('Rank() is deprecated, use score() instead.');

        return $this->score($dataset);
    }

    /**
     * Apply the transformer stack to a dataset.
     *
     * @param \Rubix\ML\Datasets\Dataset $dataset
     */
    protected function preprocess(Dataset $dataset) : void
    {
        foreach ($this->transformers as $transformer) {
            $dataset->apply($transformer);
        }
    }

    /**
     * Allow methods to be called on the estimator from the wrapper.
     *
     * @param string $name
     * @param mixed[] $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        foreach ($arguments as $argument) {
            if ($argument instanceof Dataset) {
                $this->preprocess($argument);
            }
        }

        return $this->base->$name(...$arguments);
    }

    /**
     * Return the string representation of the object.
     *
     * @return string
     */
    public function __toString() : string
    {
        return 'Pipeline (' . Params::stringify($this->params()) . ')';
    }
}

<?php declare(strict_types=1);

namespace Tests\Support;

use JsonException;
use RuntimeException;

trait SampleLoader
{
    /**
     * Loads a sample data file from the "samples" directory.
     *
     * @param string $filename The sample base filename.
     * @return string
     * @throws RuntimeException When the file cannot be read.
     */
    protected function loadSample(string $filename): string
    {
        $filepath = dirname(__DIR__) . '/samples/' . $filename;
        if (($data = @file_get_contents($filepath)) === false) {
            throw new RuntimeException(sprintf('Cannot load sample file "%s"', $filename));
        }
        return $data;
    }

    /**
     * Loads a sample json file from the "samples" directory.
     *
     * @param string $filename The sample base filename (including file extension).
     * @return mixed
     * @throws JsonException When the sample data cannot be decoded to json.
     */
    protected function loadJsonSample(string $filename): mixed
    {
        $data = $this->loadSample($filename);
        return json_decode($data, associative: true, flags: JSON_THROW_ON_ERROR);
    }
}
<?php

namespace Elanode\FileParsers;

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;

class CsvParser
{
    /**
     * The CSV content, must be opened first
     * 
     * @var string
     */
    protected $content;

    /**
     * The CSV header array
     * 
     * @var array
     */
    protected $headers;

    /**
     * Read the data from n+1 row
     * 
     * @var int
     */
    protected $offset;

    /**
     * CSV delimiter
     * 
     * @var string
     */
    protected $delimiter;

    public function __construct()
    {
        $this->offset = 1;
        $this->delimiter = ';';
    }

    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function setDelimiter(int $delimiter): self
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    public function parseToIterableData(): TabularDataReader
    {
        $reader = Reader::createFromString($this->content)
            ->setHeaderOffset(0)
            ->setDelimiter($this->delimiter);

        $stmt = Statement::create()
            ->offset($this->offset);

        $records = $stmt->process($reader, $this->headers);

        return $records;
    }

    public function parseToArray(): array
    {
        $dataSet = $this->parseToIterableData();

        $result = [];
        foreach ($dataSet as $data) {
            array_push($result, $data);
        }

        return $result;
    }
}

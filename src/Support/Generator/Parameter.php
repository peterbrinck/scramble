<?php

namespace Dedoc\Scramble\Support\Generator;

class Parameter
{
    public string $name;

    /**
     * Possible values are "query", "header", "path" or "cookie".
     */
    public string $in;

    public bool $required = false;

    public string $description = '';

    public bool $deprecated = false;

    public bool $allowEmptyValue = false;

    public ?Schema $schema = null;

    public function __construct(string $name, string $in)
    {
        $this->name = $name;
        $this->in = $in;

        if ($this->in === 'path') {
            $this->required = true;
        }
    }

    public static function make(string $name, string $in)
    {
        return new static($name, $in);
    }

    public function toArray(): array
    {
        $result = array_filter([
            'name' => $this->name,
            'in' => $this->in,
            'required' => $this->required,
            'description' => $this->description,
            'deprecated' => $this->deprecated,
            'allowEmptyValue' => $this->allowEmptyValue,
        ]);

        if ($this->schema) {
            $result['schema'] = $this->schema->toArray();
        }

        return $result;
    }

    public function required(bool $required)
    {
        $this->required = $required;

        return $this;
    }

    public function setSchema(?Schema $schema): self
    {
        $this->schema = $schema;

        return $this;
    }

    public function description(string $description)
    {
        $this->description = $description;

        return $this;
    }
}

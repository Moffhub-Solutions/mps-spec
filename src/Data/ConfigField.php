<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class ConfigField
{
    /**
     * @param  array<string>|null  $forCapabilities  Which capabilities require this field (null = always required)
     */
    public function __construct(
        public string $key,
        public string $label,
        public string $type,
        public bool $required = true,
        public bool $secret = false,
        public ?string $description = null,
        public ?string $placeholder = null,
        public ?array $forCapabilities = null,
    ) {}

    /**
     * @param  array<string>  $enabledCapabilities
     */
    public function isRequiredForCapabilities(array $enabledCapabilities): bool
    {
        if ($this->forCapabilities === null) {
            return $this->required;
        }

        return !empty(array_intersect($this->forCapabilities, $enabledCapabilities));
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'label' => $this->label,
            'type' => $this->type,
            'required' => $this->required,
            'secret' => $this->secret,
            'description' => $this->description,
            'placeholder' => $this->placeholder,
            'for_capabilities' => $this->forCapabilities,
        ];
    }
}

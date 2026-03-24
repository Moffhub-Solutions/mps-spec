<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class ConfigField
{
    public function __construct(
        public string $key,
        public string $label,
        public string $type,
        public bool $required = true,
        public bool $secret = false,
        public ?string $description = null,
        public ?string $placeholder = null,
    ) {}

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
        ];
    }
}

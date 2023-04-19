<?php

    namespace App\Entity;

    class systemConfig{
        private int $id;
        private ?string $name;
        private ?string $value;
        private ?string $tipeofHTML;
        private ?int $category;
        private string $configKey;

        public function __construct(?string $name, ?string $value, ?string $tipeofHTML, ?int $category, string $configKey){
            $this->name = $name;
            $this->value = $value;
            $this->tipeofHTML = $tipeofHTML;
            $this->category = $category;
            $this->configKey = $configKey;
        }
        
        public function setId(int $id): void{
            $this->id = $id;
        }
        
        public function getId(): int{
            return $this->id;
        }
        
        public function setName(?string $name): void{
            $this->name = $name;
        }
        
        public function getName(): ?string{
            return $this->name;
        }
        
        public function setValue(?string $value): void{
            $this->value = $value;
        }
        
        public function getValue(): ?string{
            return $this->value;
        }
        
        public function setTipeofHTML(?string $tipeofHTML): void{
            $this->tipeofHTML = $tipeofHTML;
        }
        
        public function getTipeofHTML(): ?string{
            return $this->tipeofHTML;
        }
        
        public function setCategory(?int $category): void{
            $this->category = $category;
        }
        
        public function getCategory(): ?int{
            return $this->category;
        }
        
        public function setConfigKey(string $configKey): void{
            $this->configKey = $configKey;
        }
        
        public function getConfigKey(): string{
            return $this->configKey;
        }
        
    }
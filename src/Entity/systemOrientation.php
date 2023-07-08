<?php

    namespace App\Entity;

    class systemOrientation {
        private int $id;
        private string $name;
        private string $type;

        public function __construct(string $name, string $type) {
            $this->name = $name;
            $this->type = $type;
        }
        
        public function setId(int $id): void {
            $this->id = $id;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function setName(string $name): void {
            $this->name = $name;
        }
        
        public function getName(): string {
            return $this->name;
        }

        public function setType(string $type): void {
            $this->type = $type;
        }

        public function getType(): string {
            return $this->type;
        }
        
    }
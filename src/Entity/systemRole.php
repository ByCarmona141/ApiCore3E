<?php

    namespace App\Entity;

    class systemRole {
        private int $id;
        private ?string $name;
        private ?int $active;

        public function __construct(?string $name, ?int $active) {
            $this->name = $name;
            $this->active = $active;
        }
        
        public function setId(int $id): void {
            $this->id = $id;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function setName(?string $name): void {
            $this->name = $name;
        }
        
        public function getName(): ?string {
            return $this->name;
        }
        
        public function setActive(?int $active): void {
            $this->active = $active;
        }
        
        public function getActive(): ?int {
            return $this->active;
        }
        
    }
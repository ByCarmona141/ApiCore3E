<?php

    namespace App\Entity;

    class systemUserStatus {
        private int $id;
        private ?string $name;
        private ?string $description;
        private ?int $active;

        public function __construct(?string $name, ?string $description, ?int $active) {
            $this->name = $name;
            $this->description = $description;
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
        
        public function setDescription(?string $description): void {
            $this->description = $description;
        }
        
        public function getDescription(): ?string {
            return $this->description;
        }
        
        public function setActive(?int $active): void {
            $this->active = $active;
        }
        
        public function getActive(): ?int {
            return $this->active;
        }
        
    }
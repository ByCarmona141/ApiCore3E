<?php

    namespace App\Entity;

    class systemMenu {
        private int $id;
        private ?string $name;
        private ?string $description;
        private ?string $href;
        private ?int $idSystemIcon;
        private ?int $category;
        private ?int $priority;
        private ?int $idSystemTypeElement;

        public function __construct(?string $name, ?string $description, ?string $href, ?int $idSystemIcon, ?int $category, ?int $priority, ?int $idSystemTypeElement) {
            $this->name = $name;
            $this->description = $description;
            $this->href = $href;
            $this->idSystemIcon = $idSystemIcon;
            $this->category = $category;
            $this->priority = $priority;
            $this->idSystemTypeElement = $idSystemTypeElement;
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
        
        public function setHref(?string $href): void {
            $this->href = $href;
        }
        
        public function getHref(): ?string {
            return $this->href;
        }
        
        public function setIdSystemIcon(?int $idSystemIcon): void {
            $this->idSystemIcon = $idSystemIcon;
        }
        
        public function getIdSystemIcon(): ?int {
            return $this->idSystemIcon;
        }
        
        public function setCategory(?int $category): void {
            $this->category = $category;
        }
        
        public function getCategory(): ?int {
            return $this->category;
        }
        
        public function setPriority(?int $priority): void {
            $this->priority = $priority;
        }
        
        public function getPriority(): ?int {
            return $this->priority;
        }
        
        public function setIdSystemTypeElement(?int $idSystemTypeElement): void {
            $this->idSystemTypeElement = $idSystemTypeElement;
        }
        
        public function getIdSystemTypeElement(): ?int {
            return $this->idSystemTypeElement;
        }
        
    }
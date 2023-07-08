<?php

    namespace App\Entity;

    class systemDocument {
        private int $id;
        private int $idSystemTemplate;
        private ?string $content;
        private ?\DateTime $dateCreate;

        public function __construct(int $idSystemTemplate, ?string $content, ?\DateTime $dateCreate) {
            $this->idSystemTemplate = $idSystemTemplate;
            $this->content = $content;
            $this->dateCreate = $dateCreate;
        }
        
        public function setId(int $id): void {
            $this->id = $id;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function setIdSystemTemplate(int $idSystemTemplate): void {
            $this->idSystemTemplate = $idSystemTemplate;
        }
        
        public function getIdSystemTemplate(): int {
            return $this->idSystemTemplate;
        }
        
        public function setContent(?string $content): void {
            $this->content = $content;
        }
        
        public function getContent(): ?string {
            return $this->content;
        }
        
        public function setDateCreate(?\DateTime $dateCreate): void {
            $this->dateCreate = $dateCreate;
        }
        
        public function getDateCreate(): ?\DateTime {
            return $this->dateCreate;
        }
        
    }
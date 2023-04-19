<?php

    namespace App\Entity;

    class systemTypeElement{
        private int $id;
        private ?string $name;

        public function __construct(?string $name){
            $this->name = $name;
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
        
    }
<?php

    namespace App\Entity;

    class systemPrivilegesUserRole {
        private int $id;
        private ?int $idSystemPrivileges;
        private ?string $objectSource;
        private ?int $objectTupla;
        private ?int $active;
        private ?int $objetcAccess;

        public function __construct(?int $idSystemPrivileges, ?string $objectSource, ?int $objectTupla, ?int $active, ?int $objetcAccess) {
            $this->idSystemPrivileges = $idSystemPrivileges;
            $this->objectSource = $objectSource;
            $this->objectTupla = $objectTupla;
            $this->active = $active;
            $this->objetcAccess = $objetcAccess;
        }
        
        public function setId(int $id): void {
            $this->id = $id;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function setIdSystemPrivileges(?int $idSystemPrivileges): void {
            $this->idSystemPrivileges = $idSystemPrivileges;
        }
        
        public function getIdSystemPrivileges(): ?int {
            return $this->idSystemPrivileges;
        }
        
        public function setObjectSource(?string $objectSource): void {
            $this->objectSource = $objectSource;
        }
        
        public function getObjectSource(): ?string {
            return $this->objectSource;
        }
        
        public function setObjectTupla(?int $objectTupla): void {
            $this->objectTupla = $objectTupla;
        }
        
        public function getObjectTupla(): ?int {
            return $this->objectTupla;
        }
        
        public function setActive(?int $active): void {
            $this->active = $active;
        }
        
        public function getActive(): ?int {
            return $this->active;
        }
        
        public function setObjetcAccess(?int $objetcAccess): void {
            $this->objetcAccess = $objetcAccess;
        }
        
        public function getObjetcAccess(): ?int {
            return $this->objetcAccess;
        }
        
    }
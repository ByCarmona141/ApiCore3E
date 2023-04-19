<?php

    namespace App\Entity;

    class systemLog{
        private int $id;
        private ?string $entity;
        private ?string $tuple;
        private ?\DateTime $date;
        private ?string $data;
        private ?int $idSystemUser;
        private ?int $idSystemAction;
        private ?string $ipAddress;
        private ?string $agent;
        private ?string $form;

        public function __construct(?string $entity, ?string $tuple, ?\DateTime $date, ?string $data, ?int $idSystemUser, ?int $idSystemAction, ?string $ipAddress, ?string $agent, ?string $form){
            $this->entity = $entity;
            $this->tuple = $tuple;
            $this->date = $date;
            $this->data = $data;
            $this->idSystemUser = $idSystemUser;
            $this->idSystemAction = $idSystemAction;
            $this->ipAddress = $ipAddress;
            $this->agent = $agent;
            $this->form = $form;
        }
        
        public function setId(int $id): void{
            $this->id = $id;
        }
        
        public function getId(): int{
            return $this->id;
        }
        
        public function setEntity(?string $entity): void{
            $this->entity = $entity;
        }
        
        public function getEntity(): ?string{
            return $this->entity;
        }
        
        public function setTuple(?string $tuple): void{
            $this->tuple = $tuple;
        }
        
        public function getTuple(): ?string{
            return $this->tuple;
        }
        
        public function setDate(?\DateTime $date): void{
            $this->date = $date;
        }
        
        public function getDate(): ?\DateTime{
            return $this->date;
        }
        
        public function setData(?string $data): void{
            $this->data = $data;
        }
        
        public function getData(): ?string{
            return $this->data;
        }
        
        public function setIdSystemUser(?int $idSystemUser): void{
            $this->idSystemUser = $idSystemUser;
        }
        
        public function getIdSystemUser(): ?int{
            return $this->idSystemUser;
        }
        
        public function setIdSystemAction(?int $idSystemAction): void{
            $this->idSystemAction = $idSystemAction;
        }
        
        public function getIdSystemAction(): ?int{
            return $this->idSystemAction;
        }
        
        public function setIpAddress(?string $ipAddress): void{
            $this->ipAddress = $ipAddress;
        }
        
        public function getIpAddress(): ?string{
            return $this->ipAddress;
        }
        
        public function setAgent(?string $agent): void{
            $this->agent = $agent;
        }
        
        public function getAgent(): ?string{
            return $this->agent;
        }
        
        public function setForm(?string $form): void{
            $this->form = $form;
        }
        
        public function getForm(): ?string{
            return $this->form;
        }
        
    }
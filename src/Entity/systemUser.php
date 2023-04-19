<?php

    namespace App\Entity;

    use Symfony\Component\Security\Core\User\UserInterface;

    /**
     * @method string getUserIdentifier()
     */
    class systemUser implements UserInterface{
        private int $id;
        private ?string $user;
        private ?string $password;
        private ?string $email;
        private ?string $selfie;
        private ?string $tag;
        private ?string $fullName;
        private ?string $address;
        private ?string $phone;
        private ?int $area;
        private ?int $idOffice;
        private ?int $idSystemUserStatus;
        private ?int $idSystemRole;
        private ?int $idEmployee;
        private ?int $tries;
        private ?string $position;
        private ?string $skype;

        public function __construct(?string $user, ?string $password, ?string $email, ?string $selfie, ?string $tag, ?string $fullName, ?string $address, ?string $phone, ?int $area, ?int $idOffice, ?int $idSystemUserStatus, ?int $idSystemRole, ?int $idEmployee, ?int $tries, ?string $position, ?string $skype){
            $this->user = $user;
            $this->password = $password;
            $this->email = $email;
            $this->selfie = $selfie;
            $this->tag = $tag;
            $this->fullName = $fullName;
            $this->address = $address;
            $this->phone = $phone;
            $this->area = $area;
            $this->idOffice = $idOffice;
            $this->idSystemUserStatus = $idSystemUserStatus;
            $this->idSystemRole = $idSystemRole;
            $this->idEmployee = $idEmployee;
            $this->tries = $tries;
            $this->position = $position;
            $this->skype = $skype;
        }
        
        public function setId(int $id): void{
            $this->id = $id;
        }
        
        public function getId(): int{
            return $this->id;
        }
        
        public function setUser(string $user): void{
            $this->user = $user;
        }
        
        public function getUser(): ?string{
            return $this->user;
        }
        
        public function setPassword(string $password): void{
            $this->password = $password;
        }
        
        public function getPassword(): ?string{
            return $this->password;
        }
        
        public function setEmail(string $email): void{
            $this->email = $email;
        }
        
        public function getEmail(): ?string{
            return $this->email;
        }
        
        public function setSelfie(string $selfie): void{
            $this->selfie = $selfie;
        }
        
        public function getSelfie(): ?string{
            return $this->selfie;
        }
        
        public function setTag(string $tag): void{
            $this->tag = $tag;
        }
        
        public function getTag(): ?string{
            return $this->tag;
        }
        
        public function setFullName(string $fullName): void{
            $this->fullName = $fullName;
        }
        
        public function getFullName(): ?string{
            return $this->fullName;
        }
        
        public function setAddress(string $address): void{
            $this->address = $address;
        }
        
        public function getAddress(): ?string{
            return $this->address;
        }
        
        public function setPhone(string $phone): void{
            $this->phone = $phone;
        }
        
        public function getPhone(): ?string{
            return $this->phone;
        }
        
        public function setArea(int $area): void{
            $this->area = $area;
        }
        
        public function getArea(): ?int{
            return $this->area;
        }
        
        public function setIdOffice(int $idOffice): void{
            $this->idOffice = $idOffice;
        }
        
        public function getIdOffice(): ?int{
            return $this->idOffice;
        }
        
        public function setIdSystemUserStatus(int $idSystemUserStatus): void{
            $this->idSystemUserStatus = $idSystemUserStatus;
        }
        
        public function getIdSystemUserStatus(): ?int{
            return $this->idSystemUserStatus;
        }
        
        public function setIdSystemRole(int $idSystemRole): void{
            $this->idSystemRole = $idSystemRole;
        }
        
        public function getIdSystemRole(): ?int{
            return $this->idSystemRole;
        }
        
        public function setIdEmployee(int $idEmployee): void{
            $this->idEmployee = $idEmployee;
        }
        
        public function getIdEmployee(): ?int{
            return $this->idEmployee;
        }
        
        public function setTries(int $tries): void{
            $this->tries = $tries;
        }
        
        public function getTries(): ?int{
            return $this->tries;
        }
        
        public function setPosition(string $position): void{
            $this->position = $position;
        }
        
        public function getPosition(): ?string{
            return $this->position;
        }
        
        public function setSkype(string $skype): void{
            $this->skype = $skype;
        }
        
        public function getSkype(): ?string{
            return $this->skype;
        }
    
        public function getRoles(): array{
            return [$this->getIdSystemRole()];
        }
    
        public function getSalt(){
            // TODO: Implement getSalt() method.
        }
    
        public function eraseCredentials(){
            // TODO: Implement eraseCredentials() method.
        }
    
        public function getUsername(): ?string{
            return $this->getUser();
        }
    
        public function __call(string $name, array $arguments){
            // TODO: Implement @method string getUserIdentifier()
        }
    }
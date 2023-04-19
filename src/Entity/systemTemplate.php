<?php

    namespace App\Entity;

    class systemTemplate{
        private int $id;
        private ?string $name;
        private ?string $header;
        private ?string $body;
        private ?string $footer;
        private ?string $orientation;
        private ?string $size;
        private ?int $headerSpacing;
        private ?int $footerSpacing;
        private ?int $frontPage;
        private ?string $script;
        private ?string $json;

        public function __construct(?string $name, ?string $header, ?string $body, ?string $footer, ?string $orientation, ?string $size, ?int $headerSpacing, ?int $footerSpacing, ?int $frontPage, ?string $script, ?string $json){
            $this->name = $name;
            $this->header = $header;
            $this->body = $body;
            $this->footer = $footer;
            $this->orientation = $orientation;
            $this->size = $size;
            $this->headerSpacing = $headerSpacing;
            $this->footerSpacing = $footerSpacing;
            $this->frontPage = $frontPage;
            $this->script = $script;
            $this->json = $json;
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
        
        public function setHeader(?string $header): void{
            $this->header = $header;
        }
        
        public function getHeader(): ?string{
            return $this->header;
        }
        
        public function setBody(?string $body): void{
            $this->body = $body;
        }
        
        public function getBody(): ?string{
            return $this->body;
        }
        
        public function setFooter(?string $footer): void{
            $this->footer = $footer;
        }
        
        public function getFooter(): ?string{
            return $this->footer;
        }
        
        public function setOrientation(?string $orientation): void{
            $this->orientation = $orientation;
        }
        
        public function getOrientation(): ?string{
            return $this->orientation;
        }
        
        public function setSize(?string $size): void{
            $this->size = $size;
        }
        
        public function getSize(): ?string{
            return $this->size;
        }
        
        public function setHeaderSpacing(?int $headerSpacing): void{
            $this->headerSpacing = $headerSpacing;
        }
        
        public function getHeaderSpacing(): ?int{
            return $this->headerSpacing;
        }
        
        public function setFooterSpacing(?int $footerSpacing): void{
            $this->footerSpacing = $footerSpacing;
        }
        
        public function getFooterSpacing(): ?int{
            return $this->footerSpacing;
        }
        
        public function setFrontPage(?int $frontPage): void{
            $this->frontPage = $frontPage;
        }
        
        public function getFrontPage(): ?int{
            return $this->frontPage;
        }
        
        public function setScript(?string $script): void{
            $this->script = $script;
        }
        
        public function getScript(): ?string{
            return $this->script;
        }
        
        public function setJson(?string $json): void{
            $this->json = $json;
        }
        
        public function getJson(): ?string{
            return $this->json;
        }
        
    }
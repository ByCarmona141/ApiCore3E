<?php

    namespace App\Entity;

    class systemTemplateFrontPage {
        private int $id;
        private string $name;
        private ?string $header;
        private string $body;
        private ?string $footer;
        private int $idSystemOrientation;
        private int $idSystemSize;
        private ?int $headerSpacing;
        private ?int $footerSpacing;
        private ?int $marginLeft;
        private ?int $marginRight;
        private ?int $marginTop;
        private ?int $marginBottom;

        public function __construct(string $name, ?string $header, string $body, ?string $footer, int $idSystemOrientation, int $idSystemSize, ?int $headerSpacing, ?int $footerSpacing, ?int $marginLeft, ?int $marginRight, ?int $marginTop, ?int $marginBottom) {
            $this->name = $name;
            $this->header = $header;
            $this->body = $body;
            $this->footer = $footer;
            $this->idSystemOrientation = $idSystemOrientation;
            $this->idSystemSize = $idSystemSize;
            $this->headerSpacing = $headerSpacing;
            $this->footerSpacing = $footerSpacing;
            $this->marginLeft = $marginLeft;
            $this->marginRight = $marginRight;
            $this->marginTop = $marginTop;
            $this->marginBottom = $marginBottom;
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
        
        public function setHeader(?string $header): void {
            $this->header = $header;
        }
        
        public function getHeader(): ?string {
            return $this->header;
        }
        
        public function setBody(string $body): void {
            $this->body = $body;
        }
        
        public function getBody(): string {
            return $this->body;
        }
        
        public function setFooter(?string $footer): void {
            $this->footer = $footer;
        }
        
        public function getFooter(): ?string {
            return $this->footer;
        }
        
        public function setIdSystemOrientation(int $idSystemOrientation): void {
            $this->idSystemOrientation = $idSystemOrientation;
        }
        
        public function getIdSystemOrientation(): int {
            return $this->idSystemOrientation;
        }
        
        public function setIdSystemSize(int $idSystemSize): void {
            $this->idSystemSize = $idSystemSize;
        }
        
        public function getIdSystemSize(): int {
            return $this->idSystemSize;
        }
        
        public function setHeaderSpacing(?int $headerSpacing): void {
            $this->headerSpacing = $headerSpacing;
        }
        
        public function getHeaderSpacing(): ?int {
            return $this->headerSpacing;
        }
        
        public function setFooterSpacing(?int $footerSpacing): void {
            $this->footerSpacing = $footerSpacing;
        }
        
        public function getFooterSpacing(): ?int {
            return $this->footerSpacing;
        }

        public function setMarginLeft(?int $marginLeft): void {
            $this->marginLeft = $marginLeft;
        }

        public function getMarginLeft(): ?int {
            return $this->marginLeft;
        }

        public function setMarginRight(?int $marginRight): void {
            $this->marginRight = $marginRight;
        }

        public function getMarginRight(): ?int {
            return $this->marginRight;
        }

        public function setMarginTop(?int $marginTop): void {
            $this->marginTop = $marginTop;
        }

        public function getMarginTop(): ?int {
            return $this->marginTop;
        }

        public function setMarginBottom(?int $marginBottom): void {
            $this->marginBottom = $marginBottom;
        }

        public function getMarginBottom(): ?int {
            return $this->marginBottom;
        }
    }
<?php

    namespace App\Entity;

    class systemTemplate {
        private int $id;
        private string $name;
        private ?string $json;
        private ?string $header;
        private string $body;
        private ?string $footer;
        private int $orientation;
        private int $size;
        private ?int $headerSpacing;
        private ?int $footerSpacing;
        private ?string $frontPage;
        private ?int $marginLeft;
        private ?int $marginRight;
        private ?int $marginTop;
        private ?int $marginBottom;
        private ?string $script;

        public function __construct(string $name, ?string $json, ?string $header, string $body, ?string $footer, int $orientation, int $size, ?int $headerSpacing, ?int $footerSpacing, ?string $frontPage, ?int $marginLeft, ?int $marginRight, ?int $marginTop, ?int $marginBottom, ?string $script) {
            $this->name = $name;
            $this->json = $json;
            $this->header = $header;
            $this->body = $body;
            $this->footer = $footer;
            $this->orientation = $orientation;
            $this->size = $size;
            $this->headerSpacing = $headerSpacing;
            $this->footerSpacing = $footerSpacing;
            $this->frontPage = $frontPage;
            $this->marginLeft = $marginLeft;
            $this->marginRight = $marginRight;
            $this->marginTop = $marginTop;
            $this->marginBottom = $marginBottom;
            $this->script = $script;
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
        
        public function setJson(?string $json): void {
            $this->json = $json;
        }
        
        public function getJson(): ?string {
            return $this->json;
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
        
        public function setOrientation(int $orientation): void {
            $this->orientation = $orientation;
        }
        
        public function getOrientation(): int {
            return $this->orientation;
        }
        
        public function setSize(int $size): void {
            $this->size = $size;
        }
        
        public function getSize(): int {
            return $this->size;
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
        
        public function setFrontPage(?string $frontPage): void {
            $this->frontPage = $frontPage;
        }
        
        public function getFrontPage(): ?string {
            return $this->frontPage;
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
        
        public function setScript(?string $script): void {
            $this->script = $script;
        }
        
        public function getScript(): ?string {
            return $this->script;
        }
        
    }
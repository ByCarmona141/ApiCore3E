<?php
    
    declare(strict_types=1);
    
    
    namespace App\Libraries;
    
    use League\Flysystem\FilesystemOperator;
    use Symfony\Component\HttpFoundation\File\UploadedFile;

    class CreateFile{
        private FilesystemOperator $defaultStorage;
    
        public function __construct(FilesystemOperator $defaultStorage){
            $this->defaultStorage = $defaultStorage;
        }
    
        public function createFile(UploadedFile $SourceFile){
            $Extension = $SourceFile->guessExtension();
            $FalseName = sprintf("%s.%s", \sha1(uniqid()), $Extension);
            
            $this->defaultStorage->writeStream(
                $FalseName,
                \fopen($SourceFile->getPathname(), 'r'),
                ['visibility' => 'public']
            );
            
            return 'repositorio/' . $FalseName;
        }
    }
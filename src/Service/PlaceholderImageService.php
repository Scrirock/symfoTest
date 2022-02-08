<?php

namespace App\Service;

use App\Interface\UniqIdentifierGeneratorInterface;
use Hashids\Hashids;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\Service\Attribute\Required;

class PlaceholderImageService {

    private $saveDirectory;
    private UniqIdentifierGeneratorInterface $generator;
    private string $placeholderServiceProviderUrl = "https://via.placeholder.com/";
    private int $minWidth = 150;
    private int $minHeight = 150;
    private Hashids $hashids;

    /**
     * PlaceholderImageService constructor.
     * @param Hashids $hashids
     */
    public function __construct(Hashids $hashids) {
        $this->hashids = $hashids;
    }

    #[Required]
    public function setUploadDirectory(ParameterBagInterface|string $directory) {
        if ($directory instanceof ParameterBagInterface) {
            $this->saveDirectory = $directory->get("upload.directory");
        }
        else {
            $this->saveDirectory = $directory;
        }
    }

    /**
     * @param int $imageWidth
     * @param int $imageHeight
     * @return string
     */
    public function getNewImageStream(int $imageWidth, int $imageHeight): string {
        if ($imageWidth < $this->minWidth || $imageHeight < $this->minHeight) {
            throw new \Error("L'image est trop petite");
        }
        $content = file_get_contents("{$this->placeholderServiceProviderUrl}/{$imageWidth}x{$imageHeight}");
        if (!$content) {
            throw new \Error("Y'a eu un soucis");
        }
        return $content;
    }

    /**
     * @param int $imageWidth
     * @param int $imageHeight
     * @return bool
     */
    public function getNewImageAndSave(int $imageWidth, int $imageHeight): bool {
        $file = $this->saveDirectory . $this->generator->generate();
        $content = $this->getNewImageStream($imageWidth, $imageHeight);
        $bytes = file_put_contents($file, $content);
        return file_exists($file) && $bytes;
    }

}
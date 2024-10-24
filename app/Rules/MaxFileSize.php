<?php
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

class MaxFileSize implements Rule
{
    private $maxSize;
    private $allowedExtensions;

    public function __construct($maxSize, $allowedExtensions)
    {
        $this->maxSize = $maxSize;
        $this->allowedExtensions = $allowedExtensions;
    }
    

    public function passes($attribute, $value)
    {
        if (!$value instanceof \Illuminate\Http\UploadedFile) {
            return false;
        }

        // Check file size in kilobytes
        return $value->getSize() <= $this->maxSize * 1024;
        // Check file extension
        $extension = strtolower($value->getClientOriginalExtension());
        return in_array($extension, $this->allowedExtensions);
    }

    

    public function message()
    {
        $extensions = implode(', ', $this->allowedExtensions);
        return "The :attribute must be below {$this->maxSize} KB and have one of the following extensions: {$extensions}.";
    }
}



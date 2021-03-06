<?php

namespace App\Jobs;

use App\Models\AdImage;
use Spatie\Image\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use App\Jobs\GoogleVisionRemoveFaces;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionRemoveFaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $ad_image_id;

    public function __construct($ad_image_id)
    {
        $this->ad_image_id = $ad_image_id;
    }

    /**
     * Execute the job.
     *
    //  * @return void
     */
    public function handle()
    {
        $i = AdImage::find($this->ad_image_id);
        if (!$i){
            return;
        }

        $srcPath = storage_path('/app/' . $i->file);

        $image = file_get_contents($srcPath);

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->faceDetection($image);
        $faces = $response->getFaceAnnotations();

        foreach($faces as $face){
            $vertices = $face->getBoundingPoly()->getVertices();

            $bounds = [];
            foreach($vertices as $vertex){
                $bounds[] =  [$vertex->getX(), $vertex->getY()];
            }

            $w = $bounds[2][0] - $bounds[0][0];
            $h = $bounds[2][1] - $bounds[0][1];
    
            $image = Image::load($srcPath);
    
            $image->watermark(base_path('public/img/blur-nuovo-1.png'))
            ->watermarkPosition('top-left')
            ->watermarkPadding($bounds[0][0], $bounds[0][1])
            ->watermarkWidth($w, Manipulations::UNIT_PIXELS)
            ->watermarkHeight($h, Manipulations::UNIT_PIXELS)
            ->watermarkFit(Manipulations::FIT_STRETCH);
            // ->apply()
            // ->watermark(base_path('public/img/presto-watermark2.png'))
            // ->watermarkPadding(50)
            // ->watermarkHeight(20, Manipulations::UNIT_PERCENT)
            // ->watermarkWidth(20, Manipulations::UNIT_PERCENT)
            // ->apply();
            
    
            $image->save($srcPath);
        }

        // $image = Image::load($srcPath);
        // $image->watermark(base_path('public/img/presto-watermark2.png'))
        // ->watermarkPadding(50)
        // ->watermarkHeight(20, Manipulations::UNIT_PERCENT)
        // ->watermarkWidth(20, Manipulations::UNIT_PERCENT)
        // ->apply();
        // $image->save($srcPath);

        $imageAnnotator->close();

    }
}

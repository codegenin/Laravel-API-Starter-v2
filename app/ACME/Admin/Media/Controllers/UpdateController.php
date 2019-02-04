<?php

namespace App\ACME\Admin\Media\Controllers;

use App\ACME\Admin\Media\Requests\UploadImageRequest;
use App\ACME\Admin\Media\Requests\DeleteMediaRequest;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Log\InvalidArgumentException;

class UpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run(UploadImageRequest $request)
    {
        try {
            
            $media                                    = Media::find($request->id);
            $media->translateOrNew('en')->title       = $request->title;
            $media->translateOrNew('fr')->title       = $request->fr_title;
            $media->translateOrNew('en')->description = $request->description;
            $media->translateOrNew('fr')->description = $request->fr_description;
            $media->translateOrNew('en')->time_period = $request->en_time_period;
            $media->translateOrNew('fr')->time_period = $request->fr_time_period;
            $media->translateOrNew('en')->medium      = $request->medium;
            $media->translateOrNew('fr')->time_period = $request->fr_time_period;
            $media->translateOrNew('en')->location    = $request->location;
            $media->translateOrNew('fr')->location    = $request->fr_location;
            $media->artist                            = $request->artist;
            $media->syncTags($request->tags);
            $media->save();
            
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}

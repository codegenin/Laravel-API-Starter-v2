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
            
            $media              = Media::find($request->id);
            $media->title       = $request->title;
            $media->description = $request->description;
            $media->location    = $request->location;
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

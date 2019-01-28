<?php

namespace App\ACME\Admin\Media\Controllers;

use App\ACME\Admin\Media\Requests\DeleteMediaRequest;
use App\Models\Like;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Log\InvalidArgumentException;

class AjaxToggleSelectedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function __invoke(Request $request)
    {
        try {
            
            switch ($request->type) {
                case 'show':
                    Media::whereIn('id', $request->images)->update([
                        'visible' => 1
                    ]);
                    break;
                case 'delete':
                    foreach ($request->images as $image) {
                        $media = Media::find($image);
                        $media->delete();
                        
                        // Remove image in likes
                        $media->likes()->delete();
                        $media->reports()->delete();
                    }
                    break;
                default:
                    Media::whereIn('id', $request->images)->update([
                        'visible' => 0
                    ]);
                    break;
                
            }
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return response()->json([
            'code'    => 200,
            'message' => 'Success!'
        ]);
    }
}

<?php

namespace App\ACME\Admin\Media\Controllers;

use App\ACME\Admin\Media\Requests\DeleteMediaRequest;
use App\Models\Like;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Log\InvalidArgumentException;

class ToggleVisibilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function __invoke(DeleteMediaRequest $request)
    {
        try {
            $media = Media::find($request->id);
            
            $visible = ($media->visible == 1) ? 0 : 1;
            $media->visible = $visible;
            $media->save();
            
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}

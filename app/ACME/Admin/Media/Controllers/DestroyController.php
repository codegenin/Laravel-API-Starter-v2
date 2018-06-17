<?php

namespace App\ACME\Admin\Media\Controllers;

use App\ACME\Admin\Media\Requests\DeleteMediaRequest;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Log\InvalidArgumentException;

class DestroyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run(DeleteMediaRequest $request)
    {
        try {
            $media = Media::find($request->id);
            $media->delete();
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}

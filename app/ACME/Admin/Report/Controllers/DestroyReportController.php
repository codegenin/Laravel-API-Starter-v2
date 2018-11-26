<?php

namespace App\ACME\Admin\Report\Controllers;

use App\ACME\Admin\Report\Requests\DeleteReportRequest;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Report;
use Psr\Log\InvalidArgumentException;

class DestroyReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run(DeleteReportRequest $request)
    {
        try {
            $media = Media::find($request->id);
            $media->reports()->delete();
            
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}

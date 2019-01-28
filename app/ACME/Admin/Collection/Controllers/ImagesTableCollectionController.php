<?php

namespace App\ACME\Admin\Collection\Controllers;

use App\ACME\Admin\Collection\Requests\StoreCollectionRequest;
use App\ACME\Admin\Tag\Resource\TagResource;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Traits\MediaTraits;
use Psr\Log\InvalidArgumentException;
use Spatie\Tags\Tag;
use Yajra\DataTables\Facades\DataTables;

class ImagesTableCollectionController extends Controller
{
    use MediaTraits;
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;
    
    /**
     * StoreController constructor.
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->middleware('auth:admin');
        $this->collectionRepository = $collectionRepository;
    }
    
    public function run($id)
    {
        try {
            $collection = $this->collectionRepository->find($id, ['category']);
            $images     = Media::where('collection_name', $collection->slug)
                ->get();
            $tags       = Tag::ordered()
                ->get();
            
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
//
//        return view('admin.collection.images_v2')->with([
//            'collection' => $collection,
//            'images'     => $images,
//            'tags'       => TagResource::collection($tags)
//        ]);
        
        return Datatables::of($images)
            ->addColumn('checkbox', function ($image) {
                return "<input name=\"images[]\" class=\"\" value=\"{$image->id}\" type=\"checkbox\">";
            })
            ->escapeColumns(['title'])
            ->addColumn('title', function ($image) {
                return $image->title;
            })
            ->addColumn('image', function($image) {
                return "<img src=\"{$image->getUrl('small')}\" alt=\"\" height=\"100\" width=\"100\">";
            })
            ->addColumn('artist', function ($image) {
                return $image->artist;
            })
            ->addColumn('location', function ($image) {
                return $image->location;
            })
            ->addColumn('time_period', function ($image) {
                return $image->time_period;
            })
            ->addColumn('visible', function($image) {
                return $image->visible ? 'YES' : 'NO';
            })
            ->addColumn('actions', function($image) {
                return $image->action_buttons;
            })
            ->setRowClass(function ($image) {
                return $image->visible ? 'row-visible' : 'row-hidden';
            })
            ->make(true);
    }
}

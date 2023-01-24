<?php

namespace App\Http\Controllers;

use App\Models\Scarves;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $scarves = Scarves::where(['public' => true])
            ->orderBy('position', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.home', ['scarves' => $scarves]);
    }

    /**
     * @param Scarves $scarf
     * @return Renderable
     */
    public function show(Scarves $scarf): Renderable
    {
        $images = [];
        foreach ($scarf->images()->get() as $key => $item) {
            $images[] = [
                'src' =>  $item->path,
                'main_image' => $item->main_image,
                'title' => $item->name,
                'index' => $key
            ];
        }

        return view('pages.scarf', ['scarf' => $scarf, 'images' => $images]);
    }
}

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
        $scarves = Scarves::where(['public' => true])->get();

        return view('pages.home', ['scarves' => $scarves]);
    }

    /**
     * @param Scarves $scarf
     * @return Renderable
     */
    public function show(Scarves $scarf): Renderable
    {
        $slideImage = [];
        foreach ($scarf->images()->get() as $item) {
            $slideImage[] = ['image' => $item->path];
        }

        return view('pages.scarf', ['scarf' => $scarf, 'slides' => $slideImage]);
    }
}

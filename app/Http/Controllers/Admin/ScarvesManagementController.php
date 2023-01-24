<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ScarvesStoreRequest;
use App\Models\Scarves;
use App\Models\ScarvesImages;
use App\Utils\FileUtils;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\JsonResponse;

class ScarvesManagementController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $data = [];
        foreach (Scarves::orderBy('position', 'asc')->orderBy('id', 'desc')->get() as $item) {
            $tmp = $item;
            $tmp['images'] = $item->images()->get();
            $data[] = $tmp;
        }

        return view('admin.scarves.index', [
            'scarves' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.scarves.form', [
            'route' => route('admin.scarves.store'),
            'type' => 'create',
        ]);
    }

    /**
     * Save and validate new client
     *
     * @param ScarvesStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ScarvesStoreRequest $request): RedirectResponse
    {
        $scarf = new Scarves();
        $scarf->name = $request->input('name');
        $scarf->slug = Str::slug($request->input('name'));
        $scarf->description = trim($request->input('description'));
        $scarf->public = (bool) $request->input('public');
        $scarf->position = (int) $request->input('position');
        $scarf->sold_out = (bool) $request->input('sold_out');
        $scarf->save();

        $this->storeImage($request, $scarf);

        return redirect()->route('admin.scarves.index')
            ->with('success', __('default.success.save'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Scarves $scarf
     * @return Renderable
     */
    public function edit(Scarves $scarf): Renderable
    {
        return view('admin.scarves.form', [
            'route' => route('admin.scarves.update', $scarf),
            'type' => 'edit',
            'scarf' => $scarf,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ScarvesStoreRequest $request
     * @param Scarves $scarf
     * @return RedirectResponse
     */
    public function update(ScarvesStoreRequest $request, Scarves $scarf): RedirectResponse
    {
        $scarf->name = $request->input('name');
        $scarf->slug = Str::slug($request->input('name'));
        $scarf->description = trim($request->input('description'));
        $scarf->public = (bool) $request->input('public');
        $scarf->position = (int) $request->input('position');
        $scarf->sold_out = (bool) $request->input('sold_out');
        $scarf->save();

        $this->storeImage($request, $scarf);
        return redirect()->route('admin.scarves.index')
            ->with('success', __('default.success.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Scarves $scarf
     * @return JsonResponse
     */
    public function destroy(Scarves $scarf): JsonResponse
    {
        foreach ($scarf->images()->get() as $image) {
            Storage::disk('local')->delete(ScarvesImages::PATH_IMAGE . $image->name);
        }

        $scarf->delete();

        return new JsonResponse(['message' => __('default.success.delete')], 200);
    }

    /**
     * Save new image
     *
     * @param ScarvesStoreRequest $request
     * @param Scarves $scarf
     * @return void
     */
    private function storeImage(ScarvesStoreRequest $request, Scarves $scarf): void
    {

        $imagesSave = [];
        try {
            if ($request->hasFile('main_image')) {
                $mainImage = $request->file('main_image');
                $nameFileMain = FileUtils::createNameFile($mainImage);

                Storage::disk('local')->put(ScarvesImages::PATH_IMAGE . $nameFileMain, file_get_contents($mainImage));
                $image = new ScarvesImages();
                $image->name = $nameFileMain;
                $image->original_name = $mainImage->getClientOriginalName();
                $image->path = '/storage/scarves/' . $nameFileMain;
                $image->main_image = true;
                $image->save();
                $imagesSave[] = $image;
            }

            if ($request->hasFile('additional_image')) {
                foreach ($request->file('additional_image') as $images) {
                    $nameFile = FileUtils::createNameFile($images);
                    Storage::disk('local')->put(ScarvesImages::PATH_IMAGE . $nameFile, file_get_contents($images));
                    $image = new ScarvesImages();
                    $image->name = $nameFile;
                    $image->original_name = $images->getClientOriginalName();
                    $image->path = '/storage/scarves/' . $nameFile;
                    $image->main_image = false;
                    $image->save();
                    $imagesSave[] = $image;
                }
            }
        } catch (\Exception $e) {
            if ($request->isMethod('POST')) {
                $scarf->delete();
            }
            redirect()->route('admin.scarves.create')
                ->with('error', __('default.error.error_load_file'));
            return;
        }
        $scarf->images()->saveMany($imagesSave);
    }

    /**
     * Remove image from scarves
     *
     * @param Scarves $scarf
     * @param ScarvesImages $image
     * @return JsonResponse
     */
    public function destroyImage(Scarves $scarf, ScarvesImages $image)
    {
        Storage::disk('local')->delete(ScarvesImages::PATH_IMAGE . $image->name);
        $image->delete();

        return new JsonResponse(['message' => __('default.success.delete_image')], 200);
    }

    /**
     *
     * @param Scarves $scarf
     * @return JsonResponse
     */
    public function changePublic(Scarves $scarf): JsonResponse
    {
        $scarf->public = !$scarf->public;
        $scarf->save();

        return new JsonResponse(['message' => __('default.success.change_public')], 200);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Contracts\{Foundation\Application, View\Factory, View\View};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected Brand $brand;
    protected mixed $path;
    private array $size = ['width' => 200, 'height' => 200];

    /**
     * @param Brand $brand
     */
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
        $this->path = config('constants.PATH_BRAND');
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('backend.brand.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $data['routeCreate'] = route('admin.brand.store');
        return view('backend.brand.create_edit', $data);
    }

    /**
     * @param BrandRequest $request
     * @return RedirectResponse
     */
    public function store(BrandRequest $request)
    {
        $input = $request->validated();

        $input['image_uri'] = $request->hasFile('image_uri') ?
            imageManipulation(
                $this->path,
                $input['slug'],
                $request->file('image_uri'),
                $this->size
            ) : NULL;

        if ($this->brand->fill($input)->save()) {
            return to_route('admin.brand.index')->with(config('constants.MESSAGE_SUCCESS'), __('trans.message.success'));
        }

        return to_route('admin.brand.index')->with(config('constants.MESSAGE_ERROR'), __('trans.message.error'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $data['routeUpdate'] = route('admin.brand.update', $id);
        $data['row'] = $this->brand->getBrandDetail($id);
        return view('backend.brand.create_edit', $data);
    }

    /**
     * @param BrandRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BrandRequest $request, int $id)
    {
        $input = $request->validated();
        $brand = $this->brand->getBrandFind($id);

        if ($request->hasFile('image_uri')) removeImageFromStorage($this->path, $brand->image_uri);

        $input['image_uri'] = $request->hasFile('image_uri') ?
            imageManipulation(
                $this->path,
                $input['slug'],
                $request->file('image_uri'),
                $this->size
            ) : $brand->image_uri;

        if ($brand->fill($input)->save()) {
            return to_route('admin.brand.index')->with(config('constants.MESSAGE_SUCCESS'), __('trans.message.success'));
        }

        return to_route('admin.brand.index')->with(config('constants.MESSAGE_ERROR'), __('trans.message.error'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->input();
            $brand = $this->brand->getBrandFind($input['data']);

            if ($brand->delete()) {
                removeImageFromStorage($this->path, $brand->image_uri);
                return response()->json(['result' => true, 'message' => __('trans.message.success')]);
            }

            return response()->json(['result' => false, 'message' => __('trans.message.error')]);
        }

        return response()->json(['result' => false, 'message' => __('trans.message.error')]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getList(Request $request)
    {
        $input = $request->input();
        $results = $this->brand->getList($input);

        $data = array();
        $data['iTotalRecords'] = $data['iTotalDisplayRecords'] = $results['total'];
        $data['aaData'] = array();

        if (count($results['model']) > 0) {
            foreach ($results['model'] as $item) {
                $data['aaData'][] = [
                    'id' => $item->id,
                    'image_uri' => showImage(config('constants.PATH_BRAND'), $item->image_uri ?? NULL),
                    'name' => e(str()->limit($item->name, 20)),
                    'status' => $item->status,
                    'created_at' => $item->created_at->format('d-m-Y'),
                    'updated_at' => $item->updated_at->format('d-m-Y'),
                    'edit_pages' => route('admin.brand.edit', $item->id),
                    'delete' => route('admin.brand.delete', $item->id),
                ];
            }
        }

        return response()->json($data);
    }
}

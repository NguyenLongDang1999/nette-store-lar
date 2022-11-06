<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\{Foundation\Application, View\Factory, View\View};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected Category $category;
    protected mixed $path;
    private array $size = ['width' => 200, 'height' => 200];

    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->path = config('constants.PATH_CATEGORY');
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data['getCategoryList'] = $this->getCategoryList();
        return view('backend.category.index', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $data['routeCreate'] = route('admin.category.store');
        $data['getCategoryList'] = $this->getCategoryList();
        return view('backend.category.create_edit', $data);
    }

    /**
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->validated();

        $input['image_uri'] = $request->hasFile('image_uri') ?
            imageManipulation(
                $this->path,
                $input['slug'],
                $request->file('image_uri'),
                $this->size
            ) : NULL;

        if ($this->category->fill($input)->save()) {
            return to_route('admin.category.index')->with(config('constants.MESSAGE_SUCCESS'), __('trans.message.success'));
        }

        return to_route('admin.category.index')->with(config('constants.MESSAGE_ERROR'), __('trans.message.error'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $data['routeUpdate'] = route('admin.category.update', $id);
        $data['row'] = $this->category->getCategoryDetail($id);
        $data['getCategoryList'] = $this->getCategoryList();
        return view('backend.category.create_edit', $data);
    }

    /**
     * @param CategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, int $id)
    {
        $input = $request->validated();
        $category = $this->category->getCategoryFind($id);

        if ($request->hasFile('image_uri')) removeImageFromStorage($this->path, $category->image_uri);

        $input['image_uri'] = $request->hasFile('image_uri') ?
            imageManipulation(
                $this->path,
                $input['slug'],
                $request->file('image_uri'),
                $this->size
            ) : $category->image_uri;

        if ($category->fill($input)->save()) {
            return to_route('admin.category.index')->with(config('constants.MESSAGE_SUCCESS'), __('trans.message.success'));
        }

        return to_route('admin.category.index')->with(config('constants.MESSAGE_ERROR'), __('trans.message.error'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->input();
            $category = $this->category->getCategoryFind($input['data']);

            if ($category->delete()) {
                removeImageFromStorage($this->path, $category->image_uri);
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
        $results = $this->category->getList($input);

        $data = array();
        $data['iTotalRecords'] = $data['iTotalDisplayRecords'] = $results['total'];
        $data['aaData'] = array();

        if (count($results['model']) > 0) {
            foreach ($results['model'] as $item) {
                $data['aaData'][] = [
                    'id' => $item->id,
                    'image_uri' => showImage(config('constants.PATH_CATEGORY'), $item->image_uri ?? NULL),
                    'name' => e(str()->limit($item->name, 20)),
                    'parent_id' => e(str()->limit($item->parentName, 20)) ?? '-',
                    'status' => $item->status,
                    'popular' => $item->popular,
                    'created_at' => $item->created_at->format('d-m-Y'),
                    'updated_at' => $item->updated_at->format('d-m-Y'),
                    'edit_pages' => route('admin.category.edit', $item->id),
                    'delete' => route('admin.category.delete', $item->id),
                ];
            }
        }

        return response()->json($data);
    }

    /**
     * @return array
     */
    private function getCategoryList(): array
    {
        $getCategoryList = $this->category->getCategoryRecursive();
        $option = [
            '' => __('trans.category.option_default'),
            0 => __('trans.category.parent_id')
        ];

        $dash = '';

        foreach ($getCategoryList as $category) {
            $option[$category->id] = e($category->name);

            if (count($category->children) > 0) {
                $option = $this->getCategoryRecursive($category->children, $option, $dash);
            }
        }

        return $option;
    }

    /**
     * @param $child
     * @param $option
     * @param $dash
     * @return mixed
     */
    public function getCategoryRecursive($child, $option, $dash)
    {
        $dash .= '|--- ';
        foreach ($child as $category) {
            $option[$category->id] = $dash . e($category->name);

            if (count($category->children) > 0) {
                return $this->getCategoryRecursive($category->children, $option, $dash);
            }
        }
        return $option;
    }
}

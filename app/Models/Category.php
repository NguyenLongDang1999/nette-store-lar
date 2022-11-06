<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'category';
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'description',
        'image_uri',
        'status',
        'popular',
        'meta_title',
        'meta_keyword',
        'meta_description'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function getList(array $input = array()): array
    {
        $query = Category::select('category.id', 'category.name', 'parent.name as parentName', 'category.image_uri', 'category.status', 'category.popular', 'category.created_at', 'category.updated_at')
            ->leftJoin('category as parent', 'parent.id', '=', 'category.parent_id');

        if (isset($input['search']['name']) && $input['search']['name'] != "") {
            $query->where('category.name', 'LIKE', '%' . trim($input['search']['name'] . '%'));
        }

        if (isset($input['search']['parent_id']) && $input['search']['parent_id'] != "") {
            $query->where('category.parent_id', $input['search']['parent_id']);
        }

        if (isset($input['search']['status']) && $input['search']['status'] != "") {
            $query->where('category.status', $input['search']['status']);
        }

        if (isset($input['search']['popular']) && $input['search']['popular'] != "") {
            $query->where('category.popular', $input['search']['popular']);
        }

        $result['total'] = $query->count();

        if (isset($input['iSortCol_0'])) {
            $sorting_mapping_array = array(
                '1' => 'category.name',
                '5' => 'category.created_at',
                '6' => 'category.updated_at',
            );

            $order = "desc";
            if (isset($input['sSortDir_0'])) {
                $order = $input['sSortDir_0'];
            }

            if (isset($sorting_mapping_array[$input['iSortCol_0']])) {
                $query->orderBy($sorting_mapping_array[$input['iSortCol_0']], $order);
            }
        }

        $result['model'] = $query->get();

        return $result;
    }

    public function getCategoryRecursive()
    {
        return Category::select('id', 'name')->where('parent_id', 0)->latest()->get();
    }

    public function getCategoryFind(int $id)
    {
        return Category::select('id', 'image_uri')->find($id);
    }

    public function getCategoryDetail(int $id): Category
    {
        return Category::select('id', 'name', 'slug', 'image_uri', 'description', 'parent_id', 'status', 'popular', 'meta_title', 'meta_keyword', 'meta_description')
            ->where('id', $id)
            ->first();
    }
}

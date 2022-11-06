<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'brand';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_uri',
        'status'
    ];

    /**
     * @param array $input
     * @return array
     */
    public function getList(array $input = array()): array
    {
        $query = Brand::select('id', 'name', 'image_uri', 'status', 'created_at', 'updated_at');

        if (isset($input['search']['name']) && $input['search']['name'] != "") {
            $query->where('name', 'LIKE', '%' . trim($input['search']['name'] . '%'));
        }

        if (isset($input['search']['status']) && $input['search']['status'] != "") {
            $query->where('status', $input['search']['status']);
        }

        $result['total'] = $query->count();

        if (isset($input['iSortCol_0'])) {
            $sorting_mapping_array = array(
                '1' => 'name',
                '3' => 'created_at',
                '4' => 'updated_at',
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

    /**
     * @param int $id
     * @return mixed
     */
    public function getBrandFind(int $id): mixed
    {
        return Brand::select('id', 'image_uri')->find($id);
    }

    public function getBrandDetail(int $id): Model|Builder|null
    {
        return Brand::select('id', 'name', 'slug', 'image_uri', 'description', 'status')->where('id', $id)->first();
    }
}

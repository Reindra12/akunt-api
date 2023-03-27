<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function getAll($cari = null, $limit = null)
    {
        $query = Product::select('id', 'name', 'description');

        if ($cari) {
            $query->where('name', 'like', "%$cari%");
        }

        if ($limit) {
            $query = $query->paginate($limit);
        } else {
            $query = $query->get();
        }

        $data = [];
        foreach ($query as $q) {
            $data[] = $q;
        }

        $item = [
            'data' => $data,
            'total_pages' => $limit != null ? (int)$query->lastPage() : 1,
            'per_page' => $limit != null ? (int)$query->perPage() : 1,
            'total_data' => $limit != null ? (int)$query->total() : count($data),
        ];

        return $item;
    }
}

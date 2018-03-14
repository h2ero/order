<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Stats
 */
class Stats extends Model
{


    public function paginate()
    {
        $perPage = Request::get('per_page', 10);

        $page = Request::get('page', 1);

        $start = ($page-1)*$perPage;

        // 运行sql获取数据数组
        $sql = 'select * from orders'; 

        $result = DB::select($sql);

        $movies = static::hydrate($result);

        $paginator = new LengthAwarePaginator($movies, $total, $perPage);

        $paginator->setPath(url()->current());

        return $paginator;
    }

    public static function with($relations)
    {
        return new static;
    }

}

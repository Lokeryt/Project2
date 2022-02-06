<?php

namespace App\Http\Filters;

use App\Http\Requests\VacRequest;
use App\Models\Vac;

class DataFilter
{
    public function filter(VacRequest $req)
    {
        $vac = Vac::query();
        if ($req->has('vacancy'))
        {
            $vac = $vac->where('post', 'LIKE', '%' .$req->vacancy. '%');
        }
        if ($req->has('type'))
        {
            $vac = $vac->where('type', $req->type);
        }
        if ($req->has('from'))
        {
            $vac = $vac->where('salary', '>', $req->from);
        }
        if ($req->has('to'))
        {
            $vac = $vac->where('salary', '<', $req->to);
        }
        $vac = $vac->paginate(5);
        return $vac;
    }

    public function sort(VacRequest $req, $vac)
    {
        $sortParameters = ['post', 'salary', 'amount'];

        foreach ($sortParameters as $value)
        {
            if ($req->has($value))
            {
                $vac = $vac->sortBy($value);
                break;
            }
        }

        return $vac;
    }
}

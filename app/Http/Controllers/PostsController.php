<?php

namespace App\Http\Controllers;

use App\Http\Filters\DataFilter;
use App\Http\Requests\VacancyRequest;
use App\Http\Requests\VacRequest;
use App\Http\Validate\ValidateXml;
use App\Models\Vac;
use App\Models\Xml;
use http\Env\Response;
use Validator;

class PostsController extends Controller
{
    public function add(VacancyRequest $req)
    {
        $vac = Vac::create($req->validated());
        return response()->json($vac, 201);
    }

    public function allData(VacRequest $req)
    {
        $vac = DataFilter::filter($req);

        if ($vac->isEmpty())
        {
            return response()->json(['error' => true, 'message' => 'Bad Request'], 400);
        }

        $vac = DataFilter::sort($req, $vac);

        return response()->json($vac->makeHidden(['external_id','created_at', 'updated_at']), 200);
    }

    public function get($id)
    {
        $vac = Vac::findOrFail($id);
        return response()->json($vac, 200);
    }

    public function update(VacancyRequest $req, $id)
    {
        $vac = Vac::findOrFail($id);
        $vac->update($req->validated());
        return response()->json($vac, 200);
    }

    public function delete($id)
    {
        $vac = Vac::findOrFail($id);
        $vac->delete();
        return response()->json(null, 204);
    }

    public function sync()
    {
        $filelist = scandir('E:\OpenServer\domains\test\public');
        $filelist = glob("*.xml");
        foreach ($filelist as $file)
        {
            $files = Xml::query();
            $xml = $files->where('name', $file)->get();
            $xmlObject = simplexml_load_file(public_path('/' . $file));

            foreach ($xmlObject as $value)
            {
                $validate = ValidateXml::validate($value);
                if ($validate->fails())
                {
                    return response()->json($validate->errors(), 400);
                }

                if ($xml->isEmpty())
                {
                    Vac::create((array)$value);
                }
                else
                {
                    $req = Vac::query()->where('external_id', $value->external_id);
                    $req->update((array)$value);
                }
            }

            if ($xml->isEmpty())
            {
                Xml::create(['name' => $file]);
            }
        }
        return response()->json(['Sync' => 'Synchronization completed successfully'],200);
    }
}

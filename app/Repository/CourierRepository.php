<?php

namespace App\Repository;

use App\Interface\CourierInterface;
use App\Models\Courier;

class CourierRepository implements  CourierInterface
{

    public function index($request)
    {
        $perPage = $request->perPage ?: 4; // Menggunakan nilai default 4 jika tidak ada permintaan perPage
        $searchKeywords = $request->search ? explode(' ', $request->search) : [];
        $level = $request->level ? explode(',', $request->level) : [];

        $data = Courier::query();
        //order
        $data = $data->when($request->order, function ($query) use ($request) {
            if ($request->order =="created_at"){
                return $query->orderBy("created_at","ASC");
            };
        }, function ($query) {
            return $query->orderBy("name");
        });

        // Search
        if (!empty($searchKeywords)) {
            $data = $data->where(function ($query) use ($searchKeywords) {
                foreach ($searchKeywords as $keyword) {
                    $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
                }
            });
        }

        //level
        if (!empty($level)) {
            $data = $data->where(function ($query) use ($level) {
              return $query->whereIn('level', $level);
            });
        }
        //pagination
        $data = $data->paginate($perPage);
        return $data;
    }

    public  function show($id){
        $data =Courier::find($id);
        return $data;
    }

    public  function store($data){
        $courier =Courier::create($data);
        return $courier;
    }
    public  function delete($data){
        $data->delete();
        $data->refresh();
        return $data;
    }

    public  function update($oldData,$newData){
        $oldData->update($newData);
        $oldData->refresh();
        return $oldData;

    }

}

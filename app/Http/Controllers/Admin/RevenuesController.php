<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RevenueResource;
use App\Models\Revenue;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class RevenuesController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.revenues');
        return view('admin.revenues.index', compact('title'));
    }
    ////////////////////////////////////////
    /// Get Revenues
    public function getRevenues(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        if (!empty($request->search_name)) {
            $searchQuery = $request->search_name;
            $list = Revenue::join('mawhobs', 'revenues.mawhob_id', '=', 'mawhobs.id')
                ->select('revenues.id as id', 'revenues.*', 'mawhobs.mawhob_full_name')
                ->where('mawhobs.mawhob_full_name', 'like', "%{$searchQuery}%")
                ->orWhere('mawhobs.mawhob_full_name_en', 'like', "%{$searchQuery}%")
                ->get();

        } elseif (!empty($request->date_from) && !empty($request->date_to)) {
            $list = Revenue::orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->whereDate('created_at', '>=', $request->date_from)
                ->whereDate('created_at', '<=', $request->date_to)
                ->get();
        } elseif (!empty($request->date_from)) {
            $list = Revenue::orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->whereDate('created_at', '=', $request->date_from)
                ->get();
        } else {
            $list = Revenue::with('mawhob')->orderByDesc('created_at')
                ->offset($offset)->take($perPage)->get();

        }


        $arr = RevenueResource::collection($list);
        $recordsTotal = Revenue::get()->count();
        $recordsFiltered = Revenue::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);

    }

}

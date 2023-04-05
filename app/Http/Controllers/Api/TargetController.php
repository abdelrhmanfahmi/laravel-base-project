<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TargetRequest;
use App\Http\Resources\ClusterResource;
use App\Models\Cluster;
use App\Models\Target;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    public function getClusterTargets()
    {
        $clusters = Cluster::with('targets')->get();
        return ClusterResource::collection($clusters);
    }

    public function store(Request $request)
    {
        $role = 'finance';
        $now = Carbon::now();
        $month = $now->month;
        $data = $request->all();
        for($i = 0 ; $i < count($data) ; $i++){
            if($role === 'finance'){
                if($data[$i]['month'] === $month){
                    Target::updateOrCreate(
                        [
                            'month' => $data[$i]['month'],
                            'cluster_id' => $data[$i]['cluster_id']
                        ],
                        [
                            'month' => $data[$i]['month'],
                            'target' => $data[$i]['target'],
                            'year' => $data[$i]['year'],
                            'cluster_id' => $data[$i]['cluster_id'],
                        ]
                    );
                }else{
                    return response()->json(['message' => 'You cant store in this month']);
                }
            }else{
                Target::updateOrCreate(
                    [
                        'month' => $data[$i]['month'],
                        'cluster_id' => $data[$i]['cluster_id']
                    ],
                    [
                        'month' => $data[$i]['month'],
                        'target' => $data[$i]['target'],
                        'year' => $data[$i]['year'],
                        'cluster_id' => $data[$i]['cluster_id'],
                    ]
                );
            }
        }
        return response()->json(['message' => 'Targets Saved Successfully.']);
        
    }

    public function getClusters($market_id , $business_unit_id)
    {
        $clusters = Cluster::where('market_id' , $market_id)->where('business_unit_id' , $business_unit_id)->get();
        return response()->json(['data' => $clusters]);
    }
}
    
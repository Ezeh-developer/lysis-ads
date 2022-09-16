<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Models\Ad;

class AdController extends Controller
{
    public function Deliver(Request $request) {
        $validation = $this->validateRequest($request);

        if($validation !== true)
            return $validation;

        return $this->getAdSet($request);
    }

    private function validateRequest($request) {
        $validation = Validator::make($request->all(), [
            'firstAd' => 'required',
            'secondAd'=>'required',
            'thirdAd' => 'required'
        ]);

        if($validation->fails())
            return $validation->errors()->toJson();

        return true;
    }

    private function getAdSet($request) {
        $ad = new Ad;

        return [
            'firstAd' => $ad->getLinkByValues($request->input('firstAd'))->first(),
            'secontAd' => $ad->getLinkByValues($request->input('secondAd'))->first(),
            'thirtAd' => $ad->getLinkByValues($request->input('thirdAd'))->first()
        ];
    }
}

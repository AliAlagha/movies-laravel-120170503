<?php

namespace App\Http\Controllers\APIs;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function json_select ($outputs) {
        $status = array("status" => false, "http_code" => 404);
        $arrays = array();

        if (count($outputs) > 0) {
            foreach ($outputs as $key => $output) {
                $arrays[$key] = $output;
                // array_push($arrays, [$key => $output]);

                if (count($output) > 0) {
                    $status["status"] = true;
                    $status["http_code"] = 200;
                }
            }
        }

        $response = array("status" => $status, "data" => $arrays);
        return $response;
    }
    public function index()
    {

        $data = Category::all()->toArray();
        return $this->json_select($data);
    }

}

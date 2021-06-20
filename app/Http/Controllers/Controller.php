<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function customDelete($model, $id)
    {
        try {
            $data = $model::withTrashed()->find($id);
            if ($data && $id) {
                if ($data->trashed()) {
                    $data->restore();
                    $data->deleted_by = null;
					$data->save();
					$msg='Record Activated successfully!';
                    return 'Record Activated successfully!';
                } else {
                    $data->delete();
                    $data->deleted_by = null;
					$data->save();
					$msg='Record Deleted successfully!';
                    return   'Record Deleted successfully!';
                }
            } else {
                 session()->flash('error', 'Sorry try again!');
            }
        } catch (\Exception | \Throwable $e) {
            return $e->getMessage();
        }
    }
}

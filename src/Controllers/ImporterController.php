<?php
namespace Weblid\Massdbinterface\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Weblid\Massdbimport\Facades\Massdbimport;

class ImporterController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('massdbinterface::import');
    }

    public function import(Request $request)
    {
        $config = config('massdbinterface.models.'.$request->model);

        if(Input::file('source_file')){
            $path = $request->file('source_file')->storeAs(
                '/tmp', Input::file('source_file')->getClientOriginalName()
            );
            $path = storage_path('app/' . $path);
        }
 
        $importer = Massdbimport::model($request->model)->source($path);

        if(array_key_exists('unique', $config)){
            $importer->unique($config['unique']);
            $importer->ifDuplicate($request->duplicate_errors);
        }

        if($request->has('relation_errors')){
            $importer->ifRelationError($request->relation_errors);
        }

        $importer->import();

        $rowsProcessed = $importer->logger()->getActions();

        return view('massdbinterface::report', ['rowsProcessed' => $rowsProcessed]);
    }
}

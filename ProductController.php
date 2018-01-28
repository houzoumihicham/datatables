<?php

namespace App\Http\Controllers\Speed;

use App\Http\Controllers\AbstractController;
use App\Http\Controllers\Traits\backend;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends AbstractController
{
    use Backend;

    protected $viewPr = 'pages.product.';
    protected $modName = 'product';
    protected $moderoute = 'product';

    public function __construct(Request $request, Product $product)
    {
        parent::__construct($request, $product);
    }

    /*----------------------------------------------------------
    ---------------------- Page Products Index ----------------
    ------------------------------------------------------------*/
    public function index()
    {
        $compact = array();
        $compact['title'] = $this->modName;
        return view($this->viewPr . 'index', ['compact' => $compact]);
    }

    /**
     * After save Model
     *
     * @param array $attributes
     * @param BaseModel $model
     * @return void
     */
    protected function afterSave($request, $model)
    {
        $model->categorys()->detach();
        $model->categorys()->attach($request['categoris']);
    }

    protected function afterUpdate($data, $model)
    {
        $this->afterSave($data, $model);
    }


    /**
     *
     * @param Request $request
     * @return Response
     */
    protected function table(Request $request)
    {
        $model = $this->model->whereRaw('1 = 1');
        $searchedColomn[] = 'name';

        $this->searchFilter($request,$searchedColomn,$model);

        $columns = array(
            2 => 'name',
            3 => 'default_image',
        );
        if ($this->request['order'][0]['column'] != 0) {
            $model = $model->orderBy($columns[$this->request['order'][0]['column']], $this->request['order'][0]['dir'])->get();
        } else {
            $model = $model->orderBy('id', $this->request['order'][0]['dir'])->get();
        }

        $iTotalRecords = count($model);
        $iDisplayLength = intval($this->request->get('length'));
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->request->get('start'));
        $sEcho = intval($this->request->get('draw'));

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        for ($i = $iDisplayStart; $i < $end; $i++) {
            $id    = $model[$i]->id;
            $img   = ($model[$i]->default_image)?'/backend/models/'.$this->modName . '/img/50x50'.$model[$i]->default_image :'/50x50no_image.png';
            $records["data"][] = array(
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="' . $id . '"/><span></span></label>',
                '<img src="'.$img.'" class="img-responsive table-img">',
                $model[$i]->name,
                '<a href="' . Route("backend." . $this->modName . ".edit", $id) . '" class="btn btn-sm btn-warning pado-regle"><i class="fa fa-pencil"></i> </a><button type="button" class="btn btn-danger btn-sm remove_model pado-regle" data-id="' . $id . '"><span class="fa fa-trash"></span></button>',
            );
        }

        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        return json_encode($records);
    }

    /**
     * Filter for Datatable
     * @param $request
     * @param $searchedColomn
     * @param $model
     * @return mixed
     */
    protected function searchFilter($request,$searchedColomn,$model){
        foreach ($searchedColomn as $data){
            $srch = $request->get($data);
            if ($srch) {
                $model = $model->where($data, 'like',  '%'.$srch.'%');
            }
        }
        return $model;
    }


}

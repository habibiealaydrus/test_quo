<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Quotation;
use App\Models\QuotationList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB; 

class QuotationItemController extends Controller
{
    public function index()
    {
        $dateNow = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime('-30 days', strtotime($dateNow)));

        if (in_array(Auth::user()->role,[1,2,3]))
        {
            $data = QuotationList::leftjoin('quotation', 'quotation.quotationId', '=', 'quotation_list.quoId')
            ->get();
            
        } elseif (in_array(Auth::user()->role,[4,5,6])) {
            $data = QuotationList::leftjoin('quotation', 'quotation.quotationId', '=', 'quotation_list.quoId')
            ->leftJoin('users', 'users.id', '=', 'quotation.usersId')
            ->where('users.compId','=', Auth()->user()->compId)
            ->get();
            
        } elseif (in_array(Auth::user()->role,[7])) {
            $data = QuotationList::leftjoin('quotation', 'quotation.quotationId', '=', 'quotation_list.quoId')
            ->where('quotation.usersId','=', Auth()->user()->id)
            ->get();
        }
        // elseif (in_array(Auth::user()->role,[5,6])){
        //     $data = QuotationList::leftjoin('quotation', 'quotation.quotationId', '=', 'quotation_list.quoId')
        //     ->leftJoin('users', 'users.id', '=', 'quotation.usersId')
        //     ->whereBetween(DB::raw('DATE(quotation_list.created_at)'), [$startDate, $dateNow])
        //     ->get();

        // }
        return view('/content/quotationItem/index', [
            'data'  => [
                'quotationItem' => $data
            ],
        ]);
    }


    

}

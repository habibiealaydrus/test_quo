<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Quotation;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $quotation = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftjoin('company', 'company.companyId', '=', 'users.compId')
            ->where('quotation.compsId','=', Auth()->user()->compId)
            ->get();

        $quotationPerUser = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftjoin('company', 'company.companyId', '=', 'users.compId')
            ->where('quotation.usersId','=', Auth()->user()->id)
            ->get();

        $allQuotation = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftjoin('company', 'company.companyId', '=', 'users.compId')
            ->get();
            
        //untuk quotation dalam 1 company
        $allQuotationInSameCompany = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->where('compId','=', Auth::user()->compId)
            ->get();

        //untuk sales per sales
        $allQuotationSalesPerUser = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftjoin('company', 'company.companyId', '=', 'users.compId')
            ->where('quotation.usersId','=', Auth()->user()->id)
            ->get();

        $allQuotationSales = Quotation::leftjoin('users', 'users.id', '=', 'quotation.usersId')
            ->leftjoin('company', 'company.companyId', '=', 'users.compId')
            ->where('quotation.compsId','=', Auth()->user()->compId)
            ->get();

        $user = User::select('users.*','B.rolesName')
        ->join('roles AS B','B.rolesId','users.role')
        ->get();

        $total = Quotation::select('quoTotal')
        ->leftjoin('quotation_list', 'quotation_list.quoId', '=', 'quotation.quotationId')
        ->leftjoin('users', 'users.id', '=', 'quotation.usersId')
        ->leftjoin('company', 'company.companyId', '=', 'users.compId')
        ->where('quotation.usersId','=', Auth()->user()->id)
        ->sum('quotation.quoTotal');

        $adminUser = User::where('users.role','=',4)
        ->where('users.compId','=', Auth()->user()->compId);
        
        $allAdminUser = User::where('users.role','=',4);

        $salesManagerUser = User::where('users.role','=',5)
        ->where('users.compId','=', Auth()->user()->compId);

        $allSalesManager = User::where('users.role', '=', 5);

        $salesAsistantManagerUser = User::where('users.role','=',6)
        ->where('users.compId','=', Auth()->user()->compId);
        
        $allAsistantManagerUser = User::where('users.role','=',6);

        $salesUser = User::where('users.role','=',7)
        ->where('users.compId','=', Auth()->user()->compId);
        
        $allSalesUser = User::where('users.role','=',7);

        $company = Company::all();

        //untu debug
        //$Auth=Auth()->user();
        return view('/content/home', [
            'data'  => [
                'allSalesUser' => $allSalesUser,
                'allAdminUser' => $allAdminUser,
                'allAsistantManagerUser' => $allAsistantManagerUser,
                'allSalesManager' => $allSalesManager,
                'quotation' => $quotation,
                'quotationPerUser' => $quotationPerUser,
                'allQuotation' => $allQuotation,
                'allQuotationInSameCompany' => $allQuotationInSameCompany,
                'allQuotationSales' => $allQuotationSales,
                'allQuotationSalesPerUser' => $allQuotationSalesPerUser,
                'user' => $user,
                'adminUser' => $adminUser,
                'salesManagerUser' => $salesManagerUser,
                'salesAsistantManagerUser' => $salesAsistantManagerUser,
                'salesUser' => $salesUser,
                'company' => $company,
                'total' => $total,
                //'Auth' => $Auth // untuk debug saja
            ],
        ]);
    }
}

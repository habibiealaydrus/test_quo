<?php

namespace App\Http\Controllers;
use App\Models\Company;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::all();
        return view('/content/company/index', [
            'data'  => [
                'company' => $company
            ],
        ]);
    }

    public function store(Request $request)
    {
        $company                    = new Company;
        $company->companyCode       = strtoupper($request->code);
        $company->companyName       = ucfirst($request->name);
        $company->companyArea       = ucfirst($request->area);
        $company->codeArea          = ucwords($request->codeArea);
        $company->logo              = $request->logo;
        $company->save();
        return back()->with('success', '👋 New Company Created Successfully');
    }

    public function delete(Request $request)
    {
        $company            = Company::find($request->companyId)->delete();
        return response()->json(); 
    }

    public function view(Request $request)
    {
        $company = Company::find($request->companyId);
    
        return view('/content/company/view', [
            'data'  => [
                'company' => $company
            ],
        ]);
    }
    public function update(Request $request)
    {
        $company                    = Company::find($request->companyId);
        $company->companyCode       = strtoupper($request->code);
        $company->companyName       = ucfirst($request->name);
        $company->companyArea       = ucfirst($request->area);
        $company->codeArea          = ucwords($request->codeArea);
        $company->update();
        
        return back()->with('success','👋 Company: '.$company->companyName.' has Updated Successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quotation;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class QuotationStatusController extends Controller
{
    public function onProcess(Request $request)
    {
        $onProcess = Quotation::find($request->quotationId);
        $onProcess->quoStatus = 'On Process';
        $onProcess->save();

        $dataNotification = new Notification;
        $dataNotification->usersId = Auth::user()->id;
        $dataNotification->rolesId = '[1,2,3,4,5,6,7]';
        $dataNotification->compsId ='[0,' . $onProcess->compsId . ']';
        $dataNotification->quotId = $onProcess->quotationId;
        $dataNotification->title = 'Status Quotation : On Process';
        $dataNotification->content = 'Quotation Code : '.$onProcess->quoCode;
        $dataNotification->follup_url = url('/quotation/viewQuotation/'.$onProcess->quoSlug);
        $dataNotification->save();

        return back()->with('success','👋 Status Quotation '.$onProcess->quoCode.' is on Process now'); 
    }

    public function doneProcess(Request $request)
    {
        $doneProcess = Quotation::find($request->quotationId);
        $doneProcess->quoStatus = 'Done';
        $doneProcess->save();

        $dataNotification = new Notification;
        $dataNotification->usersId = Auth::user()->id;
        $dataNotification->rolesId = '[1,2,3,4,5,6,7]';
        $dataNotification->compsId ='[0,' . $doneProcess->compsId . ']';
        $dataNotification->quotId = $doneProcess->quotationId;
        $dataNotification->title = 'Status Quotation : Done';
        $dataNotification->content = 'Quotation Code : '.$doneProcess->quoCode;
        $dataNotification->follup_url = url('/quotation/viewQuotation/'.$doneProcess->quoSlug);
        $dataNotification->save();
        
        return back()->with('success','👋 Status Quotation '.$doneProcess->quoCode.' is Done now'); 
    }

    public function canceledProcess(Request $request)
    {
        $canceledProcess = Quotation::find($request->quotationId);
        $canceledProcess->quoStatus = 'Canceled';
        $canceledProcess->save();

        $dataNotification = new Notification;
        $dataNotification->usersId = Auth::user()->id;
        $dataNotification->rolesId = '[1,2,3,4,5,6,7]';
        $dataNotification->compsId ='[0,' . $canceledProcess->compsId . ']';
        $dataNotification->quotId = $canceledProcess->quotationId;
        $dataNotification->title = 'Status Quotation : Canceled';
        $dataNotification->content = 'Quotation Code : '.$canceledProcess->quoCode;
        $dataNotification->follup_url = url('/quotation/viewQuotation/'.$canceledProcess->quoSlug);
        $dataNotification->save();

        return back()->with('success','👋 Status Quotation '.$canceledProcess->quoCode.' is Canceled now'); 
    }

    public function changeStatus(Request $request)
    {
        $changeStatus = Quotation::find($request->quotationId);
        $changeStatus->quoStatus = $request->status;
        $changeStatus->save();

        $dataNotification = new Notification;
        $dataNotification->usersId = Auth::user()->id;
        $dataNotification->rolesId = '[1,2,3,4,5,6,7]';
        $dataNotification->compsId ='[0,' . $changeStatus->compsId . ']';
        $dataNotification->quotId = $changeStatus->quotationId;
        $dataNotification->title = 'Update : Status Quotation';
        $dataNotification->content = 'Quotation Code : '.$changeStatus->quoCode;
        $dataNotification->follup_url = url('/quotation/viewQuotation/'.$changeStatus->quoSlug);
        $dataNotification->save();

        return back()->with('success','👋 Status Quotation '.$changeStatus->quoCode.' has Updated Successfully'); 
    }
}

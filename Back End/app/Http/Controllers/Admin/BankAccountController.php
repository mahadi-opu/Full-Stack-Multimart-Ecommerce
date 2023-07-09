<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function bankList(){
       $bankList= BankAccount::where('deleted',0)->get();
        return view('adminPanel.bank_account.bank_list')->with(compact('bankList'));
    }
    public function bankStore(Request $request){
        $bankAccount=new BankAccount();
        $bankAccount->bank_name=$request->bank_name;
        $bankAccount->phone=$request->phone;
        $bankAccount->note=$request->note;
        $bankAccount->account_type=$request->account_type;
        $bankAccount->account_number=$request->account_number;
        $bankAccount->phone=$request->phone;
        $bankAccount->branch_name=$request->branch_name;
        $bankAccount->available_balance=$request->available_balance;
        $bankAccount->available_balance=$request->available_balance;
        $bankAccount->save();
      return redirect()->back()->with('success','Bank Account Created Successfully ');
    }

    public function bankUpdate(Request $request){
        $bankAccount=BankAccount::find($request->bank_id);
        $bankAccount->bank_name=$request->bank_name;
        $bankAccount->phone=$request->phone;
        $bankAccount->note=$request->note;
        $bankAccount->account_type=$request->account_type;
        $bankAccount->account_number=$request->account_number;
        $bankAccount->phone=$request->phone;
        $bankAccount->branch_name=$request->branch_name;
        $bankAccount->available_balance=$request->available_balance;
        $bankAccount->available_balance=$request->available_balance;
        $bankAccount->save();
        return redirect()->back()->with('success','Bank Account Updated d Successfully ');
    }
}

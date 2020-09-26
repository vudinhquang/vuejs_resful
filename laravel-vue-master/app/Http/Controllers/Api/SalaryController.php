<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function paid(Request $request,$id){

        $request->validate([
            'salary_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = DB::table('salaries')->where('employee_id', $id)->where('salary_month', $month)->first();
        if ($check) {
           return response()->json('Salary Already Paid');
        }else{
            $data = array();
            $data['employee_id'] = $id;
            $data['amount'] = $request->salary;
            $data['salary_date'] = date('d/m/Y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('Y');
            DB::table('salaries')->insert($data);
        }
    }

    public function allSalary(){
        $salary = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salary);
    }

    public function ViewSalary($id){

    }
}
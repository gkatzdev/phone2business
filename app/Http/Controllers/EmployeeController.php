<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Input;

class EmployeeController extends Controller
{

    protected $employeeId;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // auth here
    }

    public function index(){
        $employees = new Employee();

        $data = $employees->listEmployees();
        return view('employees')->with($data);
    }

    public function insertEmployee(Request $request){
        $data = [
            'company_id' => Input::get('companyId'),
            'name' => Input::get('name')
        ];

        $employee = new Employee();
        $employee = $employee->insertEmployee($data);

        if($employee)
            return json_encode(true);
        return json_encode(false);
    }

    public function updateEmployee(Request $request){
        $employeeId = Input::get('employeeId');
        $data = [
            'company_id' => Input::get('companyId'),
            'name' => Input::get('name')
        ];
        $employee = new Employee();
        $employee = $employee->updateEmployee($data, $employeeId);

        if($employee)
            return json_encode(true);
        return json_encode(false);
    }

    public function deleteEmployee(Request $request){
        $employeeId = Input::get('employeeId');
        $employee = new Employee();
        $employee = $employee->deleteEmployee($employeeId);

        if($employee)
            return json_encode(true);
        return json_encode(false);
    }
}

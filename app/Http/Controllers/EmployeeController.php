<?php
/**
 * Created by Gabriela Katz
 * Date: 05/05/2016
 */
namespace App\Http\Controllers;

use App\Company;
use App\Employee;
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
        $companies = new Company();
        $companies = $companies->listCompanies();

        $data = $employees->listEmployees();
        return view('employees')->with([
            'data' => $data,
            'companies' => $companies
        ]);
    }

    public function getEmployee(Employee $employee, $employeeId){
        $employees = $employee->getEmployee($employeeId);
        return $employees;
    }

    public function insertEmployee(Request $request){
        $data = [
            'company_id' => Input::get('company_id'),
            'name' => Input::get('name')
        ];

        $employee = new Employee();
        $employee = $employee->insertEmployee($data);

        if($employee)
            return json_encode(true);
        return json_encode(false);
    }

    public function updateEmployee(Request $request){
        $employeeId = Input::get('employee_id');
        $data = [
            'company_id' => Input::get('company_id'),
            'name' => Input::get('name')
        ];
        $employee = new Employee();
        $employee = $employee->updateEmployee($data, $employeeId);

        if($employee)
            return json_encode(true);
        return json_encode(false);
    }

    public function deleteEmployee(Request $request){
        $employeeId = Input::get('employee_id');
        $employee = new Employee();
        $employee = $employee->deleteEmployee($employeeId);

        if($employee)
            return json_encode(true);
        return json_encode(false);
    }
}

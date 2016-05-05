<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Input;

class CompanyController extends Controller
{

    protected $companyId;

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
       $companies = new Company();

       $data = $companies->listCompanies();
       return view('employees')->with($data);
   }

    public function insertCompany(Request $request){
        $data = [
            'name' => Input::get('name')
        ];

        $company = new Company();
        $company = $company->insertCompany($data);

        if($company)
            return json_encode(true);
        return json_encode(false);
    }

    public function updateCompany(Request $request){
        $companyId = Input::get('companyId');
        $data = [
            'name' => Input::get('name')
        ];
        $company = new Company();
        $company = $company->updateCompany($data, $companyId);

        if($company)
            return json_encode(true);
        return json_encode(false);
    }

    public function deleteCompany(Request $request){
        $companyId = Input::get('employeeId');
        $company = new Company();
        $company = $company->deleteCompany($companyId);

        if($company)
            return json_encode(true);
        return json_encode(false);
    }
}

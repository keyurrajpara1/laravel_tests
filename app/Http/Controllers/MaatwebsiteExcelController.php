<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel as ExcelFacade;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Excel;

class MaatwebsiteExcelController extends Controller
{
    private $excel;
    
    public function __construct(Excel $excel){
        $this->excel = $excel;
    }

    // public function test1(Excel $excel){
    public function test1(){
        // return Excel::download(new UsersExport, 'users.xlsx');
        // return (new UsersExport)->download('users.xlsx');
        // return new UsersExport;
        // return $excel->download(new UsersExport, 'users.xlsx');
        // return $this->excel->download(new UsersExport, 'users.xlsx');
        // return $this->excel->download(new UsersExport, 'users.csv');
        // return $this->excel->download(new UsersExport, 'users.csv', Excel::CSV);
        // return $this->excel->download(new UsersExport, 'users.pdf', Excel::DOMPDF);
        return $this->excel->download(new UsersExport, 'users.xlsx');
    }
}

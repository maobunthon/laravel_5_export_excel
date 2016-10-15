<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Excel;

use Route;

class ExcelController extends Controller
{
    public function index() {
        $data = array(
            'route' => Route::current(),
            'name' => Route::currentRouteName(),
            'action' => Route::currentRouteAction()
        );

        // return $data;

        return view('excels.import');
    }

    public function import(Request $request) {

        $customer = $request->file('customer');

        Excel::load($customer, function($reader) {

            // dd($reader->toArray());

            dd($reader->all());

            $reader->each(function($sheet) {
                $customers[] = $sheet->toArray();
            });

        });
    }

    public function export() {
        $file = Excel::create('test_export', function($excel) {

            $excel->sheet('first sheet', function($sheet) {

                $sheet->fromArray(array(
                    array('id' => 100, 'fullname' => 'ravuth yo', 'phone' => '0964577770'),
                    array('id' => 102, 'fullname' => 'voot yo', 'phone' => '0964577770')
                ));

                $sheet->freezeFirstRow();

                // $sheet->with(
                $sheet->fromArray(
                    array(
                        // first line store to be header
                        array('id', 'firstname', 'lastname', 'gender', 'phone'),
                        // store to records
                        array('1', 'ravuthz', 'yo', 'male', '0964577770'),
                        array('2', 'voot', 'yo', 'male', '0964577770'),
                        array('2', 'mile', 'jack', 'male', '0964577770')
                    )

                );

                $sheet->row(2, function($row) {
                    $row->setFontColor('#FFFFFF');
                    $row->setBackground('#000000');
                });

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  12,
                        'bold'      =>  true
                    )
                ));

            });

            // Set the title
            // $excel->setTitle('Our new awesome title');

            // Chain the setters
            // $excel->setCreator('Maatwebsite')
                  // ->setCompany('Maatwebsite');

            // Call them separately
            // $excel->setDescription('A demonstration to change the file properties');

        });
        // ->export('xlsx');
        // ->download('xlsx');
        $file->export('xlsx');
        dd($file);
    }
}

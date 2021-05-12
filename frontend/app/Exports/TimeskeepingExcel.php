<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TimeskeepingExcel implements FromView, WithStyles , ShouldAutoSize
{
    private $_data;
    private $_month;
    private $_year;
    public function __construct($data,$month,$year)
    {
        $this->_data = $data;
        $this->_month = $month;
        $this->_year = $year;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = $this->_data;
        $month = $this->_month;
        $year = $this->_year;
        $title = "Báo cáo lương tháng $month năm $year";
        $time = "tháng $month năm $year";
        return view('timekeeping::partial.table-data',[
            "listDay" =>$data["listDay"],
            "users" => $data["users"],
            "titleExcel" => $title,
            "timeExcel" => $time,
            "timeskeeping" => $data["timekeeping"]
        ]);
    }
    public function styles(Worksheet $sheet)
    {
        $month = $this->_month;
        $year = $this->_year;
        $data = $this->_data;
        $munberDayInMonth = (int) date('t',strtotime(date("$year-$month-t")));

        if ($munberDayInMonth == 31){
            $numberColumn = "BK";
        }else if ($munberDayInMonth == 30 ){
            $numberColumn = "BI";
        }else if ($munberDayInMonth == 29) {
            $numberColumn = "BG";
        }else{
            $numberColumn = "BE";
        }
        $numberRows = count($data["users"]) + 4;
        return [
            "A3:$numberColumn$numberRows"   => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
                'alignment' => [
                    'wrapText' => true,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                ]
            ],
            1 => [
                'font' => ['size'=>20,'bold'=>true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ],
            2 => [
                'font' => ['size'=>12,'bold'=>true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ],
            3 => [
                'font' => ['size'=>12, 'bold'=>true],
                'alignment' => [
                    'wrapText' => true,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ],
            4 => [
                'font' => ['size'=>12, 'bold'=>true],
                'alignment' => [
                    'wrapText' => true,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ]
        ];
    }

}

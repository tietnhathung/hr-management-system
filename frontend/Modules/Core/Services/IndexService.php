<?php


namespace Modules\Core\Services;


use Illuminate\Support\Facades\DB;

class IndexService
{
    private $from_date,$to_date, $to_day,$date;
    public function __construct(){
        $now = date('Y-m-d',strtotime(now()));
        $this->from_date = date('Y-m-d H:i:s',strtotime($now. "-7 day"));
        $this->to_date = date('Y-m-d 23:59:59',strtotime($now));
        $this->to_day = date('d-m',strtotime($now));
    }

    public function voucherReceiving(){
        $rawData = DB::table("voucher_receiving as t1")
                    ->leftJoin("voucher_receiving_detail as t2","t1.id","t2.voucher_receiving_id")
                    ->whereBetween("t1.created_at" , [$this->from_date,$this->to_date])
                    ->selectRaw("
                        DATE_FORMAT(t1.created_at, '%d-%m') as date,
                        t1.created_at,
                        IFNULL(SUM(t2.quantity), 0) total
                    ")
                    ->groupBy("date")
                    ->get()->keyBy("date");
        $data = array(
            "today" => isset($rawData[$this->to_day]->total)? (int)$rawData[$this->to_day]->total : 0
        );
        $dates = $this->dateRange();
        foreach ($dates as $date){
            $data["chart"]["data"][] =isset($rawData[$date]->total)?  (int) $rawData[$date]->total :0;
            $data["chart"]["labels"][] = $date;
        }
        return $data;

    }

    public function voucherDelivery(){
        $rawData = DB::table("voucher_delivery as t1")
            ->leftJoin("voucher_delivery_detail as t2","t1.id","t2.voucher_delivery_id")
            ->whereBetween("t1.created_at" , [$this->from_date,$this->to_date])
            ->selectRaw("
                DATE_FORMAT(t1.created_at, '%d-%m') as date,
                t1.created_at,
                IFNULL(SUM(t2.quantity), 0) total
            ")
            ->groupBy("date")
            ->get()->keyBy("date");

        $data = array(
            "today" => isset($rawData[$this->to_day]->total) ? (int)$rawData[$this->to_day]->total : 0
        );
        $dates = $this->dateRange();
        foreach ($dates as $date){
            $data["chart"]["data"][] = isset($rawData[$date]->total) ? (int) $rawData[$date]->total : 0;
            $data["chart"]["labels"][] = $date;
        }
        return $data;
    }

    public function stock(){
        $rawData = DB::table("stock as t1")
            ->leftJoin("stock_product as t2","t1.id","t2.stock_id")
            ->selectRaw("
                t1.id,
                t1.name,
                IFNULL(SUM(t2.quantity), 0) total
            ")
            ->groupBy("t1.id")
            ->get()
            ->keyBy("id");

        $data = array(
            "all" => $rawData->sum("total"),
            "chart" => []
        );
        foreach ($rawData as $raw){
            $data["chart"]["data"][] = (int)$raw->total??0;
            $data["chart"]["labels"][] = $raw->name;
        }
        return $data;
    }

    private function dateRange( ) {
        $dates = array();
        $step = '+1 day';
        $format = 'd-m';
        $current = strtotime(now(). "-7 day");
        $last = strtotime(now());

        while( $current <= $last ) {

            $dates[] = date( $format, $current );
            $current = strtotime( $step, $current );
        }

        return $dates;
    }
}

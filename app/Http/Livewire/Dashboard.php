<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetail;
use DateTime;

class Dashboard extends Component
{

    public $year, $salesByMonth_Data=[], $top5Data=[], $weekSales_Data =[], $listYears=[];

    public function mount()
    {
        if($this->year=='') $this->year = date('Y');
    }
    public function render()
    {
        $this->listYears =[];
        $curentYear = date('Y')-1;
        for($i=1;$i<6;$i++){
            array_push($this->listYears, $curentYear + $i);
        }
        $this->getTop5();
        $this->getWeekSales();
        return view('livewire.dash.component')->layout('layouts.theme.app');
    }

    public function getTop5(){
        $this->top5Data = OrderDetail::join('products as p','order_details.product_id','p.id')->select(DB::raw("p.name as product, sum(order_details * p.price)as total"))->wereYear('order_details.created_at', $this->year)->groupBy('p.name')->orderBy(DB::raw("sum(order_details.quantity * p.price)"), 'desc')->get()->take(5)->toArray();

        $contDif = (5-count($this->top5Data));
        if($contDif >0){
            for($i=1;$i<=$contDif;$i++){
                array_push($this->top5Data,["product"=>"-","total"=>0]);
            }
        }
            # code...
    }

    public function getWeekSales()
    {
       $dt = new DateTime();
       $dates =[];
       $starDate = null;
       $finisDate= null;

       $this->weekSales_Data =[];

       for($d=1;$d<=7;$d++){
            $dt->setISODate($dt->format('o'), $dt->format('W'), $d);

            $startDate = $dt->format('y-m-d').'00:00:00';
            $finisDate = $dt->format('y-m-d').'23:59:59';

            $startDate = substr_replace($startDate, $this->year,0,4);
            $finisDate = substr_replace($finisDate, $this->year,0,4);

            $wsale = Order::whereBetween('created_at',[$startDate,$finisDate])->sum('total');

            array_push($this->weekSales_Data,$wsale);
        }
    }

}

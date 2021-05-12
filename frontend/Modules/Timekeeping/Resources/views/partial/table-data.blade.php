<table id="data" class="table table-data table-bordered table-sticky">
    <thead>
        @if (isset($titleExcel))
            <tr>
                <th colspan="24">{{$titleExcel}}</th>
            </tr>
        @endif
        @if (isset($timeExcel))
            <tr>
                <th colspan="24">{{$timeExcel}}</th>
            </tr>
        @endif

        <tr>
            <th rowspan="2" class="td-th-stick">
                Ngày công
            </th>
            @foreach($listDay as $day)
                @php
                    $class = $day['dayOff'] ? "bg-warning" : "";
                @endphp
                <th colspan="2" class="{{$class}}">
                    {{date('d/m/Y',strtotime($day["date"]))}}<br/>{{$day["thu"]}}
                </th>
            @endforeach
        </tr>
        <tr>
            @foreach($listDay as $day)
                @php
                    $class = $day['dayOff'] ? "bg-warning" : "";
                @endphp
                <th class="{{$class}}">Vào việc</th>
                <th class="{{$class}}">Tan ca</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        @php
            $timeskeepingofuser = null;
            if (isset($timeskeeping[$user->id])&&!empty($timeskeeping[$user->id])){
                $timeskeepingofuser = $timeskeeping[$user->id]->keyBy('working_day')->toArray();

            }
        @endphp
        <tr>
            <td class="td-th-stick">
                {{$user->fullname}}
            </td>
            @foreach($listDay as $day)
                @php
                    $date = date('Y-m-d',strtotime($day["date"]));
                    $timeInDay = null;
                    if (isset($timeskeepingofuser[$date])){
                         $timeInDay = $timeskeepingofuser[$date];
                    }
                    $class = $day['dayOff'] ? "bg-warning" : ( $timeInDay != null ?  "" :"bg-danger");
                @endphp
                @if( $timeInDay != null )
                    <td class="{{$class}}">
                        {{$timeInDay["get_to_work"]}}
                    </td>
                    <td class="{{$class}}">
                        {{$timeInDay["get_off_work"]}}
                    </td>
                @else
                    <td class="{{$class}}"></td>
                    <td class="{{$class}}"></td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>



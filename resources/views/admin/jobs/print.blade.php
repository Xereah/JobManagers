@extends('layouts.admin2')
@section('content')
<!DOCTYPE html>
<html>

<head>
    <script src="{{ asset('js/main.js') }}"></script>
    <style> 

    @media print {

        /* Zastosuj obramowania dla elementów */
        hr,
        .border {
            border: 2px solid black !important;
        }

        body {
            font-size: 22px;
            padding: 0;
            margin: 0;
        }

        table {
            font-size: 22px;
            
        }
        @page {
    margin-top: 0;
    margin-bottom: 0;
  }
  /* Ukryj domyślny nagłówek */
  header {
    display: none;
  }
        
    }
    </style>
</head>

 <body onload="window.print()"> 



    <div class="card-body " id="printThis">

        <div class="row d-flex justify-content-center align-items-center">
            <div style="display: flex; align-items: center;">
                <img alt="Qries" src="{{ asset('/img/logo.png')}}" width="80" height="100">
                <h2 style="margin-left: 2%;"><strong> POTWIERDZENIE/ZLECENIE WYKONANIA USŁUG<br>
                        DLA ZLECENIA: {{ $job->order ?? '' }}</strong>
                </h2>
            </div>
        </div>

        <div class="border"></div>

        <br>
        <table align="center">
            <tr>
                <td style="width:30%;">
                    <div><strong>Akronim Klienta:</strong> {{ $job->company ->shortcode ?? '' }}</div>
                    <div><strong>Klient:</strong> {{ $job->company -> name ?? '' }} <br>
                        {{ $job->company -> street ?? '' }} {{ $job->company -> zipcode ?? '' }}
                        {{ $job->company -> location ?? '' }} </div>
                    <div><strong>Mejsce wykonania usług:</strong><br> {{ $job->company -> street ?? ''}}
                        {{$job->company -> zipcode ?? ''}}
                        {{$job->company -> location ?? ''}}</div>
                </td>
                <td style="width:15%;"></td>
                <td style="width:30%;">
                    <div><strong>Data zgłoszenia:</strong> {{ $job->start_date ?? '' }}</div>
                    <div><strong>Zgłaszający:</strong> {{ $job->user->name ?? '' }} {{ $job->user->surname ?? '' }}
                    </div>
                    <div><strong>Przyjmujący:</strong> {{ $job->user->name ?? '' }} {{ $job->user->surname ?? '' }}
                    </div>
                    <div><strong>Data rozpoczęcia:</strong> {{ $job->start_date ?? '' }} </div>
                    <div><strong>Data zakończenia:</strong> {{ $job->end_date ?? '' }} </div>
                    <div><strong>Czas trwania:</strong> {{  $minsandsecs  }}</div>
                </td>
            </tr>
        </table>

        <br>
        <h2 class="mb-3 text-center"><strong>Szczegółowy spis wykonanych usług przez serwis Kasper Komputer:</strong>
        </h2>
        <div>
            <table class="table">
                <thead class="border">
                    <tr>
                        <th >Lp</th>
                        <th > {{ trans('cruds.job.fields.task_name') }}</th>   
                        <th >{{ trans('cruds.job.fields.description') }}</th>
                        <th > {{ trans('cruds.job.fields.performed') }}</th>
                        <th > {{ trans('cruds.job.fields.time') }}</th>
                        <th > RR.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    @foreach($jobs as $key => $job)
                    <tr>
                        <td class="center">{{$i}}</td>
                        <td class="left strong"> {{ $job->type_task->name ?? '' }}</td>
                       <td></td>
                        <?php
                        $zmienna1=$job->user->name;
                        $zmienna2=$job->user->surname;
                        $firstLetter1 = substr($zmienna1, 0, 1);
                        $firstLetter2 = substr($zmienna2, 0, 1);
                        ?>
                        <td class="left"> {{ $firstLetter1 }} {{  $firstLetter2  ?? '' }}</td>
                        <td class="right"> {{ date('G:i', strtotime($job->time)) ?? '' }} h</td>
                        @if($job->paid==1)
                        <td class="right"> B</td>
                        @else
                        <td class="right"> P</td>
                        @endif
                    </tr>
                    <tr>
                        <td colspan="7" >{{ $job->description ?? '' }}</td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <!-- <div class="border"></div> -->

        <!-- <div class="row justify-content-around mb-5">
            <div class="col-4 text-center">
                {{ trans('cruds.job.fields.performed') }}
            </div>
            <div class="col-4 text-center">
                Potwierdzam wykonane zadania
            </div>
        </div> -->

        <!-- <div class="row justify-content-around mb-5">
            <div class="col-4 text-center">
                <hr>
                {{ $job->user->name ?? '' }} {{ $job->user->surname ?? '' }}
            </div>
            <div class="col-4 text-center">
                <hr>
                Nazwisko i imię oraz podpis
                upoważnionego przedstawiciela Klienta
            </div>
        </div> -->

        <footer class="fixed-bottom">
        <div class="row justify-content-around mb-5">
            <div class="col-4 text-center">
                <hr>
                {{ $job->user->name ?? '' }} {{ $job->user->surname ?? '' }}
            </div>
            <div class="col-4 text-center">
                <hr>
                Nazwisko i imię oraz podpis
                upoważnionego przedstawiciela Klienta
            </div>
        </div>
  <div class="container">
    <div class="row">
      <div class="col-sm">
        Legenda:<br>
        RR.- Rodzaj Rozliczenia wykonanej Usługi: (P- Usługa Płatna, B- Usługa Bezpłatna)<br>
      </div>
    </div>
    <div class="border"></div>
    <div>
      Kasper Komputer, ul. Podmiejska 16, 62-800 Kalisz, tel/fax (0-62) 764-40-66, 501-15-05
    </div>
  </div>
</footer>


       

    </div>

    </div>
    <!-- <button class="btn btn-success btn-fill pull-right" id="btnPrint">Print</button> -->
    <!-- <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-add" name="form-button-add" onclick="window.print()">
            CREATE 
        </button> -->

</body>

</html>
@endsection


<script>
document.getElementById("btnPrint").onclick = function() {
    printElement(document.getElementById("printThis"));

    var modThis = document.querySelector("#printSection .modifyMe");
    modThis.appendChild(document.createTextNode(" new"));

    window.print();
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";

    $printSection.appendChild(domClone);
}
</script>

 <script>
         setTimeout(function(){
            window.history.back()
         }, 3000);
      </script>  
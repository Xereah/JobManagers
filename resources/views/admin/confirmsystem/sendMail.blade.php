<!DOCTYPE html>
<html>

<head>
    <script src="{{ asset('js/main.js') }}"></script>
    <style>
    @media print {

        /* Zastosuj obramowania dla elementów */
        hr,
        {
            border: 2px solid black !important;
        }
        .obramowanie {
            border: 1rem solid;
        }


        body {
            font-size: 14px;
            padding: 0;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        footer {
            margin-top: auto;
        }

        table {
            font-size: 14px;

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

    body {
        font-family: DejaVu Sans;
        font-size: 14px;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    header {
        padding: 20px;
    }

    main {
        flex: 1;
        padding: 20px;
    }

    footer {

        padding: 20px;
        margin-top: auto;
    }
    </style>
</head>

<body>
    <main>
        <!-- Nagłowek -->
        <table>
            <tbody>
                <tr>
                    <td><img src="{{ asset('/img/logo.png')}}" width="80" height="100"></td>
                    <td>
                        <h2><strong> POTWIERDZENIE/ZLECENIE WYKONANIA USŁUG<br>
                                DLA ZLECENIA: {{ $job->order ?? '' }}</strong>
                        </h2>
                    </td>
                    <td>&nbsp;</td>

                </tr>
            </tbody>
        </table>
<hr>
        <table>
            <tbody>
                <tr>
                    <td style="width:30%; text-align: left;">
                        <div><strong>Akronim Klienta:</strong> {{ $job->company ->shortcode ?? '' }}</div>
                        <div><strong>Klient:</strong> {{ $job->company -> name ?? '' }} <br>
                            {{ $job->company -> street ?? '' }} {{ $job->company -> zipcode ?? '' }}
                            {{ $job->company -> location ?? '' }} </div>
                        <div><strong>Mejsce wykonania usług:</strong><br> {{ $job->company -> street ?? ''}}
                            {{$job->company -> zipcode ?? ''}}
                            {{$job->company -> location ?? ''}}</div>
                    </td>
                    <td align="center" style="width:40%; visibility: hidden;">
                        ----------------------------
                    </td>
                    <td style="width:30%; text-align: left;">
                        <strong>Data zgłoszenia:</strong> {{ $job->start_date ?? '' }}<br>
                        <strong>Zgłaszający:</strong> {{ $job->user->name ?? '' }} {{ $job->user->surname ?? '' }}<br>
                        <strong>Przyjmujący:</strong> {{ $job->user->name ?? '' }} {{ $job->user->surname ?? '' }}<br>
                        <strong>Data rozpoczęcia:</strong> {{ $job->start_date ?? '' }}<br>
                        <strong>Data zakończenia:</strong> {{ $job->end_date ?? '' }}<br>
                        <strong>Czas trwania:</strong> {{  $minsandsecs  }}<br>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <h3 align="center"><strong>Szczegółowy spis wykonanych usług przez serwis Kasper Komputer:</strong></h3>

        <table>
            <thead >
                <tr >
                    <th>Lp</th>
                    <th>{{ trans('cruds.job.fields.task_name') }}</th>
                    <th>{{ trans('cruds.job.fields.description') }}</th>
                    <th>{{ trans('cruds.job.fields.performed') }}</th>
                    <th>Jm</th>
                    <th>RR.</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>

                @foreach($jobs as $key => $job)
                <tr>
                    <td align="center">{{$i}}</td>
                    <td align="left" class="strong"><b> {{ $job->task_type->name ?? '' }}</b></td>
                    <td></td>
                    <?php
                        $zmienna1=$job->user->name;
                        $zmienna2=$job->user->surname;
                        $firstLetter1 = substr($zmienna1, 0, 1);
                        $firstLetter2 = substr($zmienna2, 0, 1);
                        ?>
                    <td align="center"> {{ $firstLetter1 }} {{  $firstLetter2  ?? '' }}</td>
                    <td align="center"> {{ date('G:i', strtotime($job->time)) ?? '' }} h</td>
                    @if($job->paid==1)
                    <td align="center"> B</td>
                    @else
                    <td align="center"> P</td>
                    @endif
                </tr>
                <tr>
                    <td colspan="7">{!! nl2br(e($job->description)) !!}</td>
                </tr>
                <?php $i++ ?>
                @endforeach
                @foreach($jobs_towary as $id => $jobs_towarys)
                <tr>
                    <td align="center">{{$i}}</td>
                    <td align="left"><b> {{ $jobs_towarys->task_type->name ?? '' }}</b></td>
                    <td align="center"> {{ $jobs_towarys->description_goods ?? '' }}</td>
                    <?php
                        $zmienna1=$job->user->name;
                        $zmienna2=$job->user->surname;
                        $firstLetter1 = substr($zmienna1, 0, 1);
                        $firstLetter2 = substr($zmienna2, 0, 1);
                        ?>
                    <td align="center"> {{ $firstLetter1 }} {{  $firstLetter2  ?? '' }}</td>
                    </td>
                    <td>szt.</td>
                    @if($job->paid==1)
                    <td align="center"> B</td>
                    @else
                    <td align="center"> P</td>
                    @endif
                </tr>
                <?php $i++ ?>
                @endforeach
                @foreach($jobs_sprzetzast as $id => $jobs_sprzetzasts)
                <tr>
                    <td align="center">{{$i}}</td>
                    <td align="left" class="strong"><b> {{ $jobs_sprzetzasts->task_type->name ?? '' }}</b></td>
                    <td align="center" class=" strong">{{ $jobs_sprzetzasts->repeq->eq_number ?? '' }}
                        {{ $jobs_sprzetzasts->repeq->eq_name ?? '' }}</td>
                    <?php
                        $zmienna1=$job->user->name;
                        $zmienna2=$job->user->surname;
                        $firstLetter1 = substr($zmienna1, 0, 1);
                        $firstLetter2 = substr($zmienna2, 0, 1);
                        ?>
                    <td align="center"> {{ $firstLetter1 }} {{  $firstLetter2  ?? '' }}</td>
                    <td>szt.</td>
                    @if($job->paid==1)
                    <td align="center"> B</td>
                    @else
                    <td align="center"> P</td>
                    @endif
                </tr>
                <?php $i++ ?>
                @endforeach
                <tr>
                    <td align="center">{{$i}}</td>
                    <td align="left" class="strong"><b> Dojazd(DKM)</b></td>
                    <td align="center" class=" strong">Dojazd samochodem osobowym</td>
                    <?php
                        $zmienna1=$job->user->name;
                        $zmienna2=$job->user->surname;
                        $firstLetter1 = substr($zmienna1, 0, 1);
                        $firstLetter2 = substr($zmienna2, 0, 1);
                        ?>
                    <td align="center"> {{ $firstLetter1 }} {{  $firstLetter2  ?? '' }}</td>
                    <td> {{$company_km}} km</td>
                    @if($job->paid==1)
                    <td align="center"> B</td>
                    @else
                    <td align="center"> P</td>
                    @endif
                </tr>
                <?php $i++ ?>
            </tbody>
        </table>
        @if($job->comments != NULL)
        <h4 align="left"><strong>OGÓLNE UWAGI DO WYKONANYCH ZADAŃ W RAMACH ZLECENIA:</strong></h4>
        <p align="left">{!! nl2br(e($job->comments)) !!}</hp>
            @endif
        <table>
            <tbody>
                <tr>
                    <td align="center" style="width:30%;">
                        <hr>{{ $job->user->name ?? '' }} {{ $job->user->surname ?? '' }}
                    </td>
                    <td align="center" style="width:40%; visibility: hidden;">
                        ----------------------------------------- -----------------------------------------
                    </td>
                    <td align="center" style="width:30%;">
                        <hr> Nazwisko i imię oraz podpis<br>
                        upoważnionego przedstawiciela klienta
                    </td>
                </tr>
            </tbody>
        </table>
        </main>
        <footer>
        <table>
            <tbody>
                <tr>
                    <td style="width:100%;"> Legenda:<br>
                        RR.- Rodzaj Rozliczenia wykonanej Usługi: (P- Usługa Płatna, B- Usługa Bezpłatna)<br>
                        <hr>
                        Kasper Komputer, ul. Podmiejska 16, 62-800 Kalisz, tel/fax (0-62) 764-40-66, 501-15-05
                    </td>
                </tr>
            </tbody>
        </table>
    </footer>

</body>

</html>
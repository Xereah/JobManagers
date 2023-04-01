<!DOCTYPE html>
<html>

<head>

</head>

<body>
  Dzień dobry, <br>
  w załączniku przesyłam potwierdzenie wizyty z dnia {{ $job->start_date ?? '' }}
<br>
<br>
  Pozdrawiam<br><br>
<strong>{{ $job->user->name ?? '' }} {{ $job->user->surname ?? '' }}</strong><br>
"KASPER KOMPUTER" Sp. z o.o.<br>
ul. Podmiejska 16<br>
62-800 Kalisz<br>
tel. 62 7644066<br>
www.kasper.pl<br>

</body>

</html>
<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
    <h1></h1>
    @foreach($jobs as $key => $job)
                    <tr>
                        <td class="center"></td>
                        <td class="left strong">    {{ $job->type_task->name ?? '' }}</td>
                        <td class="left strong"> {{ $job->description ?? '' }}</td>
                        <td class="left"> {{ $job->user->name ?? '' }} {{ $job->user->surname ?? '' }}</td>
                        <td class="right"> {{ date('G:i', strtotime($job->time)) ?? '' }} h</td>
                        @if($job->paid==1)
                        <td class="right"> B</td>
                        @else
                        <td class="right"> P</td>
                        @endif
                    </tr>
                   
                @endforeach
     
    <p>Thank you</p>
</body>
</html>
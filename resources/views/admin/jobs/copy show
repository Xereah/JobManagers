

<div class="card">
    <div class="card-header bg-dark">
        {{ trans('global.show') }} {{ trans('cruds.job.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.task') }}
                        </th>
                        <td>
                        {{ $job->task_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.project') }}
                        </th>
                        <td>
                        {{ $job->project -> name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.company') }}
                        </th>
                        <td>
                        {{ $job->company -> shortcode ?? '' }}    
                        </td>
                    </tr>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.performed') }}
                        </th>
                        <td>
                        {{ $job->user->name ?? '' }}  {{ $job->user->surname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.time') }}
                        </th>
                        <td>
                        {{ date('G:i', strtotime($job->end) - strtotime($job->start)) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.beginning') }}
                        </th>
                        <td>
                        {{ $job->start_date ?? '' }} <br>
                                {{ $job->start ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.end') }}
                        </th>
                        <td>
                                {{ $job->end_date ?? '' }} <br>
                                {{ $job->end ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.place') }}
                        </th>
                        <td>
                        {{$job->new_location->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.category') }}
                        </th>
                        <td>
                        {{ $job->categories->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.rns') }}
                        </th>
                        <td>
                        {{ $job->rns ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        {{ trans('cruds.job.fields.description') }}
                        </th>
                        <td>
                        {{ $job->description ?? '' }}
                        </td>
                    </tr>
                 
                    
                    
                </tbody>
            </table>
            <!-- <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a> -->
        </div>


    </div>
</div>

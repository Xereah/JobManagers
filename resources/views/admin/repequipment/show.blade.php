


<div class="history-container" style="margin:5px; padding:5px;">
    <h2>Historia Sprzętu</h2>
    @foreach($RepEquipmentHistory as $RepEquipmentHistorys)
    <div class="history-item border">
        <p class="date">{{$RepEquipmentHistorys ->modified_at}}</p>
        <p class="change">
            @if($RepEquipmentHistorys->field_name == 'company_place')
            <strong>Pole:</strong> {{ trans('cruds.rep_eq.fields.place') }}<br>

            @elseif($RepEquipmentHistorys->field_name == 'comments')
            <strong>Pole:</strong> {{ trans('cruds.rep_eq.fields.comments') }}<br>

            @elseif($RepEquipmentHistorys->field_name == 'entry_date')
            <strong>Pole:</strong> {{ trans('cruds.rep_eq.fields.entry_date') }}<br>

            @elseif($RepEquipmentHistorys->field_name == 'serial_number')
            <strong>Pole:</strong> {{ trans('cruds.rep_eq.fields.serial_number') }}<br>

            @elseif($RepEquipmentHistorys->field_name == 'eq_name')
            <strong>Pole:</strong> {{ trans('cruds.rep_eq.fields.device_name') }}<br>

            @elseif($RepEquipmentHistorys->field_name == 'eq_number')
            <strong>Pole:</strong> {{ trans('cruds.rep_eq.fields.number') }}<br>

            @elseif($RepEquipmentHistorys->field_name == 'eq_category')
            <strong>Pole:</strong> {{ trans('cruds.rep_eq.fields.category') }}<br>
            @endif

            @if($RepEquipmentHistorys->field_name != 'company_place' && $RepEquipmentHistorys->field_name !=
            'eq_category')
            <strong>Stara wartość:</strong> {{ $RepEquipmentHistorys->old_value }}<br>
            @elseif($RepEquipmentHistorys->field_name == 'company_place')
            <strong>Stara wartość:</strong> {{ $RepEquipmentHistorys->company->kontrahent_kod }}<br>
            @elseif($RepEquipmentHistorys->field_name == 'eq_category')
            <strong>Stara wartość:</strong> {{ $RepEquipmentHistorys->EqCategorytwo->category_name }}<br>
            @endif

            @if($RepEquipmentHistorys->field_name != 'company_place' && $RepEquipmentHistorys->field_name !=
            'eq_category')
            <strong>Nowa wartość:</strong> {{ $RepEquipmentHistorys->new_value }}
            @elseif($RepEquipmentHistorys->field_name == 'company_place')
            <strong>Nowa wartość:</strong> {{ $RepEquipmentHistorys->company->kontrahent_kod }}
            @elseif($RepEquipmentHistorys->field_name == 'eq_category')
            <strong>Nowa wartość:</strong> {{ $RepEquipmentHistorys->EqCategory->category_name }}
            @endif

        </p>
    </div>
    @endforeach
</div>
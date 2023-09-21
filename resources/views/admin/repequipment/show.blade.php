


<div class="history-container" style="margin:5px; padding:5px;">
    <h2>Historia Sprzętu</h2>
    <table class=" table table-bordered table-hover datatable" id="example">
                <thead>
                
                    <tr>
                        <th>
                            Sprzęt
                        </th>
                        <th>
                            Firma
                        </th>
                        <th>
                            Osoby wydająca
                        </th>
                        <th>
                            Data wydania
                        </th>
                        <th>
                            Data zwrotu
                        </th>
                        <th>
                           Uwagi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($RepEquipmentHistory as $key => $RepEquipments)
                    <tr data-entry-id="{{ $RepEquipments->id }}">
                      
                        <td>
                            {{$RepEquipments->EqCategory->eq_number ?? ''}}

                        </td>
                        <td>
                            {{$RepEquipments->company->kontrahent_kod ?? ''}}
                        </td>
                        <td>
                            {{$RepEquipments->UserCategory->name ?? ''}}  {{$RepEquipments->UserCategory->surname ?? ''}}
                        </td>
                        <td>
                            {{$RepEquipments->rental_date ?? ''}}
                        </td>
                        <td>
                            {{$RepEquipments->return_date ?? ''}}
                        </td>
                        <td>
                            {{$RepEquipments->description ?? ''}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

</div>
<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd"
    type="button">{{ trans('parent.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50"
        style="text-align: center">
        <thead>
            <tr class="table-success">
                <th>#</th>
                <th>{{ trans('parent.Email') }}</th>
                <th>{{ trans('parent.Name_Father') }}</th>
                <th>{{ trans('parent.National_ID_Father') }}</th>
                <th>{{ trans('parent.Passport_ID_Father') }}</th>
                <th>{{ trans('parent.Phone_Father') }}</th>
                <th>{{ trans('parent.Job_Father') }}</th>
                <th>{{ trans('parent.Processes') }}</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($my_parents as $my_parent)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $my_parent->email }}</td>
                    <td>{{ $my_parent->name_father }}</td>
                    <td>{{ $my_parent->national_id_father }}</td>
                    <td>{{ $my_parent->passport_id_father }}</td>
                    <td>{{ $my_parent->phone_father }}</td>
                    <td>{{ $my_parent->job_father }}</td>
                    <td>
                        <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('grades_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})"
                            title="{{ trans('grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
    </table>
</div>

<div class="m-3">
    @can('animal_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.animals.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.animal.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.animal.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userAnimals">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.animal.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.animal.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.animal.fields.icon') }}
                            </th>
                            <th>
                                {{ trans('cruds.animal.fields.gender') }}
                            </th>
                            <th>
                                {{ trans('cruds.animal.fields.breed') }}
                            </th>
                            <th>
                                {{ trans('cruds.animal.fields.pet_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.animal.fields.user') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($animals as $key => $animal)
                            <tr data-entry-id="{{ $animal->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $animal->id ?? '' }}
                                </td>
                                <td>
                                    {{ $animal->title ?? '' }}
                                </td>
                                <td>
                                    @if($animal->icon)
                                        <a href="{{ $animal->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $animal->icon->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ App\Models\Animal::GENDER_SELECT[$animal->gender] ?? '' }}
                                </td>
                                <td>
                                    {{ $animal->breed->type ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Animal::PET_TYPE_SELECT[$animal->pet_type] ?? '' }}
                                </td>
                                <td>
                                    {{ $animal->user->name ?? '' }}
                                </td>
                                <td>
                                    @can('animal_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.animals.show', $animal->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('animal_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.animals.edit', $animal->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('animal_delete')
                                        <form action="{{ route('admin.animals.destroy', $animal->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('animal_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.animals.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-userAnimals:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
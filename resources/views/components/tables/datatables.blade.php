@push('css')
<link rel="stylesheet" href="{{ asset('vendor/kuber/css/components/tables/datatables.css') }}">
@endpush

<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                @foreach ($head as $item)
                    <th scope="col">{{ __('kuber::components/tables/datatables.' . $item) }}</th>
                @endforeach

                @if ($actions)
                    <th scope="col">{{ __('kuber::components/tables/datatables.actions') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    @foreach ($item->toArray() as $key => $value)
                        @if (in_array($key, $head))
                            @if ($key == 'id')
                                <th scope="row">{{ $value }}</th>
                            @else
                                <td>
                                    @switch($key)
                                        @case('name')
                                            @if($image)
                                            <img src="{{ asset($item->image()) }}" alt="{{ $item->name }}"
                                            class="img-fluid img-circle mr-2 border border-dark" style="width: 30px">
                                            @endif
                                            {{ $value }}
                                        @break

                                        @case('created_at')
                                            {{ $formatData($value) }}
                                        @break

                                        @case('updated_at')
                                            {{ $formatData($value) }}
                                        @break

                                        @default
                                            {{ $value }}
                                    @endswitch
                                </td>
                            @endif
                        @endif
                    @endforeach

                    @if ($action)
                        <td class="kuber-datatables-actions">
                            @foreach($actions as $actionItem)
                            @if($actionItem['action'] == 'delete')
                            <form action="{{ route($actionItem['route'], [$item]) }}" method="post">
                                @csrf
                                @method('delete')

                                <button type="submit" class="kuber-datatables-action kuber-datatables-action-{{ $actionItem['action'] }}" title="{{ __('kuber::components/tables/datatables.' . $actionItem['action']) }}">
                                    <i class="fas fa-{{ $actionItem['icon'] }}"></i>
                                </button>
                            </form>
                            @else
                            <a href="{{ route($actionItem['route'], [$item]) }}" class="kuber-datatables-action kuber-datatables-action-{{ $actionItem['action'] }}" title="{{ __('kuber::components/tables/datatables.' . $actionItem['action']) }}">
                                <i class="fas fa-{{ $actionItem['icon'] }}"></i>
                            </a>
                            @endif
                            @endforeach
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

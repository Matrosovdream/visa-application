@foreach( array_chunk($travellerFieldCategories, 2) as $cats ) 

    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10 mb-5">

        @foreach( $cats as $cat ) 

            <div class="card card-flush py-4 flex-row-fluid">

                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ $cat['title'] }}</h2>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">

                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <tbody class="fw-semibold text-gray-600">

                                @if( isset($groupedFields[ $cat['slug'] ]) ) 

                                    @php
                                    //dd($groupedFields[ $cat['slug'] ]);
                                    @endphp

                                    @foreach( $groupedFields[ $cat['slug'] ] as $field )

                                        <tr>
                                            <td class="text-muted text-start">{{ $field['title'] }}</td>
                                            <td class="text-start text-gray-800">
                                                
                                                @if( isset($field['valueRef']) )
                                                    {{ $field['valueRef'] }}
                                                @else
                                                    {{ $field['value'] ?? '' }}
                                                @endif

                                            </td>
                                        </tr>

                                    @endforeach

                                @endif

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        @endforeach

    </div>

@endforeach
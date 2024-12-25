
@foreach($formFields as $field)

    @if($field['type'] == 'text')

        <div class="mb-3 xb-item--field field-block-{{ $field['slug'] }}">
            <label for="field-{{ $field['slug'] }}" class="form-label  w-100">
                {{ $field['title'] }} {{ $field['required'] ? '*' : '' }}
            </label>
            <input 
                type="text" 
                class="form-control w-75" 
                id="field-{{ $field['slug'] }}" name="fields[{{ $field['slug'] }}]"
                value="{{ $field['value'] }}"
                placeholder="{{ $field['placeholder'] }}"
                >
            @if( isset($field['icon']) ) 
                <span class="icon">
                    <img src="{{ asset('/user/assets/img/icon/'.$field['icon']) }}" alt="">
                </span>
            @endif
        </div>

    @endif

    @if($field['type'] == 'phone')

        <div class="mb-3 xb-item--field field-block-{{ $field['slug'] }}">
            <label for="field-{{ $field['slug'] }}" class="form-label  w-100">
                {{ $field['title'] }} {{ $field['required'] ? '*' : '' }}
            </label>
            <input 
                type="text" 
                class="form-control w-75" 
                id="field-{{ $field['slug'] }}" name="fields[{{ $field['slug'] }}]"
                value="{{ $field['value'] }}"
                placeholder="{{ $field['placeholder'] }}"
                >
            @if( isset($field['icon']) ) 
                <span class="icon">
                    <img src="{{ asset('/user/assets/img/icon/'.$field['icon']) }}" alt="">
                </span>
            @endif
        </div>

    @endif

    @if($field['type'] == 'email')

        <div class="mb-3 xb-item--field field-block-{{ $field['slug'] }}">
            <label for="field-{{ $field['slug'] }}" class="form-label  w-100">
                {{ $field['title'] }} {{ $field['required'] ? '*' : '' }}
            </label>
            <input 
                type="email" 
                class="form-control w-75" 
                id="field-{{ $field['slug'] }}" name="fields[{{ $field['slug'] }}]"
                value="{{ $field['value'] }}"
                placeholder="{{ $field['placeholder'] }}"
                >
            @if( isset($field['icon']) ) 
                <span class="icon">
                    <img src="{{ asset('/user/assets/img/icon/'.$field['icon']) }}" alt="">
                </span>
            @endif
        </div>

    @endif

    @if($field['type'] == 'textarea')

        <div class="mb-3 xb-item--field field-block-{{ $field['slug'] }}">
            <label for="field-{{ $field['slug'] }}" class="form-label  w-100">
                {{ $field['title'] }} {{ $field['required'] ? '*' : '' }}
            </label>
            <textarea 
                class="form-control w-75" 
                id="field-{{ $field['slug'] }}" 
                name="fields[{{ $field['slug'] }}]"
                placeholder="{{ $field['placeholder'] }}"
                >{{ $field['value'] }}</textarea>
            @if( isset($field['icon']) ) 
                <span class="icon">
                    <img src="{{ asset('/user/assets/img/icon/'.$field['icon']) }}" alt="">
                </span>
            @endif
        </div>

    @endif

    @if($field['type'] == 'date')

        <div class="mb-3 xb-item--field field-block-{{ $field['slug'] }}">
            <label for="field-{{ $field['slug'] }}" class="form-label  w-100">
                {{ $field['title'] }} {{ $field['required'] ? '*' : '' }}
            </label>
            <input type="text" class="form-control w-50 datepicker-min-today min-5-alert {{ $field['classes'] ?? '' }}" id="field-{{ $field['slug'] }}" name="fields[{{ $field['slug'] }}]" value="{{ $field['value'] }}">
            @if( isset($field['icon']) ) 
                <span class="icon">
                    <img src="{{ asset('/user/assets/img/icon/'.$field['icon']) }}" alt="">
                </span>
            @endif
        </div>

    @endif

    @if($field['type'] == 'select')

        <div class="mb-3 xb-item--field field-block-{{ $field['slug'] }}">
            <label for="field-{{ $field['slug'] }}" class="form-label  w-100">
                {{ $field['title'] }} {{ $field['required'] ? '*' : '' }}
            </label>
            <div class="w-75">
            <select class="select2 w-75" id="field-{{ $field['slug'] }}" name="fields[{{ $field['slug'] }}]">
                <option selected disabled>{{ $field['placeholder'] }}</option>
                @foreach($field['options'] as $option)
                    <option value="{{ $option['id'] }}" @if( $option['id'] == $field['value'] ) selected @endif>
                        {{ $option['title'] }}
                    </option>
                @endforeach
            </select>
            </div>
        </div>

    @endif

    @if($field['type'] == 'file')

        <div class="mb-3 xb-item--field field-block-{{ $field['slug'] }}">
            <label for="field-{{ $field['slug'] }}" class="form-label  w-100">
                {{ $field['title'] }} {{ $field['required'] ? '*' : '' }}
            </label>
            @if( isset($field['value']) )
                <a href="{{ Storage::url($field['value']->path) }}" target="_blank">
                    {{ __('Download') }}
                </a>
            @endif    

            <input type="file" class="form-control w-75" id="field-{{ $field['slug'] }}" name="fields[{{ $field['slug'] }}]">
        </div>

    @endif

    @if($field['type'] == 'radio')

        <div class="mb-3 xb-item--field field-block-{{ $field['slug'] }}">
            <label for="field-{{ $field['slug'] }}" class="form-label">
                {{ $field['title'] }} {{ $field['required'] ? '*' : '' }}
            </label>
            @foreach($field['options'] as $option)
                <div class="form-check">
                    <label class="form-check" for="field-{{ $field['slug'] }}-{{ $option['value'] }}">
                        <input class="form-check" type="radio" value="{{ $option['value'] }}"
                            id="field-{{ $field['slug'] }}-{{ $option['value'] }}" name="fields[{{ $field['slug'] }}]"
                            @if( $option['value'] == $field['value'] ) checked @endif
                            >
                        {{ $option['title'] }}
                    </label>
                </div>
            @endforeach
        </div>

    @endif

    @if($field['type'] == 'checkbox')

        <div class="mb-3 xb-item--field field-block-{{ $field['slug'] }}">
            <label for="field-{{ $field['slug'] }}" class="form-label">
                {{ $field['title'] }} {{ $field['required'] ? '*' : '' }}
            </label>
            <div class="form-check">
                <input class="form-check w-75" type="checkbox" id="field-{{ $field['slug'] }}"
                    @if( $field['value'] == 1 ) checked @endif
                    name="fields[{{ $field['slug'] }}]">
            </div>
        </div>

    @endif

@endforeach
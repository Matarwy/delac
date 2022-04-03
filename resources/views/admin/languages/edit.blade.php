<div class="card">
    <div class="card-header">
        <h4>{{__('Edit Language')}}</h4>
    </div>
    <form action="{{ route('languages.update', [$language->id]) }}" method="POST">

        @csrf
        @method("PUT")
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name',$language->name) }}">
                    </div>
                    @error('name')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-12 ">
                    <div class="form-group">
                        <label>{{ __('Status') }}</label>
                        <select name="status" class="form-control select2-dd @error('status') is-invalid @enderror"
                            required>
                            <option value="0" {{$language->status == 0 ? 'selected' : ''}}>{{('De-Active')}}</option>
                            <option value="1" {{$language->status == 1 ? 'selected' : ''}}>{{('Active')}}</option>

                        </select>
                    </div>
                    @error('status')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>

            </div>

        </div>

        <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
        </div>
    </form>
</div>
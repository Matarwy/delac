<div class="card">
    <div class="card-header">
        <h4>{{__('Edit Category')}}</h4>
    </div>
    <form action="{{ route('categories.update', [$category->id]) }}" method="POST">

        @csrf
        @method("PUT")
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name',$category->name) }}">
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
                            <option value="0" {{$category->status == 0 ? 'selected' : ''}}>{{__('De-Active')}}</option>
                            <option value="1" {{$category->status == 1 ? 'selected' : ''}}>{{__('Active')}}</option>

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
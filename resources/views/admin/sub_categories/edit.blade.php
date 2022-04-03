<div class="card">
    <div class="card-header">
        <h4>{{__('Edit Sub Category')}}</h4>
    </div>
    <form action="{{ route('sub-categories.update', [$subCategory->id]) }}" method="POST">

        @csrf
        @method("PUT")
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name',$subCategory->name) }}">
                    </div>
                    @error('name')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>
                <div class="col-12 col-md-12 col-lg-12 ">
                    <div class="form-group">
                        <label>{{ __('Category') }}</label>
                        <select name="category_id"
                            class="form-control select2-dd @error('category_id') is-invalid @enderror" required>
                            @foreach ($categories as $cat)

                            <option value="{{$cat->id}}" {{$subCategory->category_id == $cat->id ? 'selected' : ''}}>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>
                <div class="col-12 col-md-12 col-lg-12 ">
                    <div class="form-group">
                        <label>{{ __('Status') }}</label>
                        <select name="status" class="form-control select2-dd @error('status') is-invalid @enderror"
                            required>
                            <option value="0" {{$subCategory->status == 0 ? 'selected' : ''}}>{{__('De-Active')}}
                            </option>
                            <option value="1" {{$subCategory->status == 1 ? 'selected' : ''}}>{{__('Active')}}</option>

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
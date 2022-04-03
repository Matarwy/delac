<div class="card">
    <div class="card-header">
        <h4>{{__('Add New Role')}}</h4>
    </div>
    <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">

        @csrf
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Permissions') }}</label>
                        <select name="permissions[]"
                            class="form-control select2-dd @error('permissions') is-invalid @enderror" required
                            multiple="">
                            @foreach ($permissions as $permission)
                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('permissions')
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
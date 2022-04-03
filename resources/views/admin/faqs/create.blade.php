<div class="card">
    <div class="card-header">
        <h4>{{__('Add New FAQ')}}</h4>
    </div>
    <form action="{{ route('faqs.store') }}" method="POST" >

        @csrf
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Question') }}</label>
                        <input type="text" name="question" class="form-control @error('question') is-invalid @enderror" required
                            maxlength="255" value="{{ old('question') }}">
                    </div>
                    @error('question')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Anser') }}</label>
                     
                            <textarea name="ans"  cols="30" rows="20" class="form-control @error('ans') is-invalid @enderror" required>{{ old('ans') }}</textarea>
                    </div>
                    @error('ans')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-12 ">
                    <div class="form-group">
                        <label>{{ __('For Who') }}</label>
                        <select name="faq_for" class="form-control select2-dd @error('faq_for') is-invalid @enderror"
                            required>
                            <option value="0">{{__('Student')}}</option>
                            <option value="1">{{__('Teacher')}}</option>

                        </select>
                    </div>
                    @error('faq_for')
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
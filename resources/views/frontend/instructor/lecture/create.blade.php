<form action="{{ route('lectures.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="lecture_title">
                <h4>{{__('Add Lecture')}}</h4>
            </div>
        </div>
        <input type="hidden" name="content_id" value={{$courseContent->id}}>
        <input type="hidden" name="course_id" value={{$courseContent->course_id}}>

        <div class="col-lg-6 col-md-12">
            <div class="ui search focus mt-30 lbel25">
                <label>{{__('Lecture Title*')}}</label>
                <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="{{__('Insert your lecture title.')}}"
                        name="title" data-purpose="edit-course-title" maxlength="255" id="title" value="" pattern="\S+"
                        title="This field is required">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="part_input mt-30 lbel25">
                <label>{{__('File*')}}</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="lectureFileInput" name="file" required>
                        <label class="custom-file-label"
                            for="inputGroupFile06">{{__('No Choose file - (Pdf, Video)')}}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="course_des_textarea mt-30 lbel25">
                <label>{{__('Description*')}}</label>
                <div class="course_des_bg">

                    <div class="textarea_dt">
                        <div class="ui form swdh339">
                            <div class="field">
                                <textarea rows="5" name="description" class="id_course_description"
                                    placeholder="{{__('Insert your  description')}}">{{old('description')}}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6">
            <div class="ui search focus mt-30 lbel25">
                <label>{{__('Volume*')}}</label>
                <div class="ui left icon input swdh19 swdh95">
                    <input class="prompt srch_explore" type="number" min="0" required="" placeholder="0" name="volume">
                    <div class="badge_num">MB</div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6">
            <div class="ui search focus mt-30 lbel25">
                <label>{{__('Duration*')}}</label>
                <div class="ui left icon input swdh19 swdh55">
                    <input class="prompt srch_explore" type="number" min="0" required="" placeholder="0"
                        name="duration">
                    <div class="badge_num">{{__('Min')}}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-12">
            <button class="part_btn_save prt-sv" type="submit">{{__('Save Lecture')}}</button>
        </div>
    </div>
</form>
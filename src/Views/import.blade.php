{!! Form::open(['id' => 'import_form', 'class' => 'form-horizontal', 'url' => '/importer/import', 'enctype'=>'multipart/form-data' ]) !!}
    
    
    <div class="form-group">
        <label class="col-xs-12" for="source_file">Upload file</label>

        <div class="col-xs-4">
            {!! Form::file('source_file') !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-12" for="model">What data type are we importing?</label>

        <div class="col-xs-4">
            
            @php

                $value = config('massdbinterface.models');
                $models = [];

                foreach($value as $model => $val){
                    $models[$model] = $val['name'];
                }

            @endphp
            {!! Form::select('model', $models) !!}

        </div>
    </div>
    <!--
    <div class="form-group">
        <label class="col-xs-12" for="validation_errors">What to do if validation error?</label>

        <div class="col-xs-4">
           
            {!! Form::radio('validation_errors', 'validation_errors', 'SKIP') !!}
            {!! Form::label('validation_errors', 'Ignore and continue'); !!}

            {!! Form::radio('validation_errors', 'validation_errors', 'QUIT') !!}
            {!! Form::label('validation_errors', 'Quit and throw error'); !!}

        </div>
    </div>
    -->
    <div class="form-group">
        <label class="col-xs-12" for="duplicate_errors">What to do if duplicate?</label>

        <div class="col-xs-4">
           
            {!! Form::radio('duplicate_errors', 'UPDATE', 'UPDATE') !!}
            {!! Form::label('duplicate_errors', 'Update the duplicate record'); !!}
            <br/>
            {!! Form::radio('duplicate_errors', 'SKIP', 'SKIP') !!}
            {!! Form::label('duplicate_errors', 'Skip that record'); !!}
            <br/>
            {!! Form::radio('duplicate_errors', 'RENAME', 'RENAME') !!}
            {!! Form::label('duplicate_errors', 'Add the record and rename unique id'); !!}
            <br/>
            {!! Form::radio('duplicate_errors', 'QUIT', 'QUIT') !!}
            {!! Form::label('duplicate_errors', 'Quit and throw error'); !!}
            <br/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12" for="relation_errors">What to do if a relation isn't found?</label>

        <div class="col-xs-4">
           
            {!! Form::radio('relation_errors', 'IGNORE', 'UPDATE') !!}
            {!! Form::label('relation_errors', 'Add the record with  no relation'); !!}
            <br/>
            {!! Form::radio('relation_errors', 'SKIP', 'SKIP') !!}
            {!! Form::label('relation_errors', 'Skip that record'); !!}
            <br/>
            {!! Form::radio('relation_errors', 'QUIT', 'QUIT') !!}
            {!! Form::label('relation_errors', 'Quit and throw error'); !!}
            <br/>
        </div>
    </div>
    <!--
    <div class="form-group">
        <label class="col-xs-12" for="import_type">What to do if validation error?</label>

        <div class="col-xs-4">
           
            {!! Form::radio('validation_errors', 'import_type', 'APPEND') !!}
            {!! Form::label('validation_errors', 'Add records to database'); !!}

            {!! Form::radio('validation_errors', 'import_type', 'DELETEFIRST') !!}
            {!! Form::label('validation_errors', 'Clear database for fresh import (Dangerous)'); !!}

        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-12" for="import_live">Import type</label>

        <div class="col-xs-4">
           
            {!! Form::radio('import_type', 'import_live', 'WRITE') !!}
            {!! Form::label('import_type', 'Ignore and continue'); !!}

            {!! Form::radio('import_type', 'import_live', 'SIMULATE') !!}
            {!! Form::label('import_type', 'Quit and throw error'); !!}

        </div>
    </div>
    -->
    <div class="form-group">
        <div class="col-xs-12">

            {!! Form::button('Import', ['id' => 'submit-button', 'class'=>"btn btn-sm btn-primary"]); !!}
        
        </div>
    </div>

{!! Form::close() !!}



<!-- Pop In Modal -->
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Terms &amp; Conditions</h3>
                </div>
                <div class="block-content">
                    <i class="fa fa-2x fa-cog fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
            </div>
        </div>
    </div>
</div>
<!-- END Pop In Modal -->

<script>
/* must apply only after HTML has loaded */
$(document).ready(function () {
    $("#import_form").on("submit", function(e) {

        e.preventDefault();

        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: formURL,
            method: "POST",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data, textStatus, jqXHR) {
                $('#modal-popin .block-title').html("Result");
                $('#modal-popin .block-content').html(data);
                
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
                $('#modal-popin .block-title').html("Error");
                $('#modal-popin .block-content').html(error);
            }
        });
        
    });
    $('#submit-button').on('click', function(){
        $('#modal-popin').modal('show');
        $("#import_form").submit();
    });

});
</script>

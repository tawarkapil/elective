<div id="page-refresh-container">
  <div id="page-refresh-box">

<?php 
  $system_documents = ViewsHelper::getSystemDocuments($sectionId);
?>
@if(count($system_documents) > 0)
<p>
  <h4>Important Documents and Resources in this section:</h4>
  <h5>For you:</h5>
  @foreach($system_documents as $row)
    <div class="mb-10">{{ $row->document_name }} (<a style="font-weight:600;" target="_blank" href="{{ url($row->document_path) }}"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
  @endforeach
</p>
@endif


<?php 
  $student_documents = ViewsHelper::getStudentDocuments($sectionId);
?>
@if(count($student_documents) > 0)
<p>
  <h4>Important Documents and Resources in this section:</h4>
  <h5>For us:</h5>
    @foreach($student_documents as $key => $row)
      <div class="mb-10 normalFileUploadContainer">{{ $row }}
        <div style="overflow:hidden;display: none;"> 
        <form>
            <input type="file" class="normalFileUploadInp" id="document_files{{$key}}" data-document="{{$key}}" data-section="{{ $sectionId }}"  name="document_files"/> 
         </form>
        </div>
        (<a style="cursor: pointer;" class="action-icon normalFileUploadBtn" title="Upload file" data-document="{{ $key }}">
           <i class="fa fa-cloud-upload" ></i> Upload
        </a>) 
        <div class="documents-progressbar-container"></div>

        <?php  
        $fileArr = ViewsHelper::displayStudentDocumentFile($sectionId, $key); 
        ?>

        @if(count($fileArr) > 0)
        <a style="color: green;font-weight: 600; font-style: italic;" target="_blank" href="{{ $fileArr['path'] }}">{{ $fileArr['filename'] }}</a>
        @endif
      </div>
    @endforeach
</p>
@endif
</div>
</div>
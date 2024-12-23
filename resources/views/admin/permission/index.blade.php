@extends('admin.layouts.app') 
@section('content')
<div class="page-breadcrumb">
   <div class="row">
      <div class="col-7 align-self-center">
         <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">Permission</li>
               </ol>
            </nav>
         </div>
         <h4 class="page-title">Permission</h4>
      </div>
   </div>
</div>
<div class="container-fluid">
   <!-- Awaiting Approval List -->
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
              <form name="permissionFrm" id="permissionFrm">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                       <thead style="background-color: #b00403;color: #FFF;">
                          <tr>
                             <th>Permission</th>
                             @foreach($roles as $key => $role)
                               <th class="text-center">
                                   {{ $role->role_title }}
                               </th>
                             @endforeach
                          </tr>
                       </thead>
                       <tbody>


                          @foreach($group_permissions as $grp => $parent_permissions)
                          <?php $permissions = $parent_permissions['permissions']; ?>
                          <tr class="table-active">
                             <td colspan="12">{{ $parent_permissions['group_name'] }}</td>
                          </tr>
                           @foreach($permissions as $key => $permission)
                          <tr class="single-row-permission" data-group="{{ $grp }}">
                             <td>{!! $permission->title !!}</td>
                             @foreach($roles as $role)
                             <td>
                              <?php

                              $chk_html = '';
                              if ($role->isChecked($role->role_id, $permission->permission_id)) {
                                $chk_html =  'checked="checked"';
                              }
                              $className = 'child-permission' .$grp. $role->role_id;

                              $className2 = '';

                              if($permission->level > 0 )
                              {
                                $className2 = ' clck-permission-level permission-level'.$grp. $permission->level.$role->role_id;


                              }
                     
                                $disble_check = '';
                              if($permission->parent){
                                $className = 'clck-parent parent-permission'.$grp . $role->role_id;
                                $className2 = '';
                              }else{
                                $disble_check = '';
                                if (!$role->isCheckedParent($role->role_id, $grp)) {
                                    $disble_check = 'disabled="disabled"';
                                }
                              }


                              $check_permission_access = true;

                              if($permission->permission_group == 'permission' && $role->role_id ==1)
                              {
                                    $check_permission_access = false;                       

                              }


                               ?>

                                <div class="custom-control custom-checkbox text-center"  @if($check_permission_access == false) style="display:none;" @endif>
                                    <input name="permission[{{ $role->role_id }}][{{ $permission->permission_id }}]" type="checkbox" {{ $chk_html }} {{ $disble_check }}  class="custom-control-input {{ $permission->extra_classes }} {{ $className }} {{ $className2 }}"  data-role="{{ $role->role_id }}" data-permission="{{ $permission->permission_id }}"  id="permission{{ $role->role_id }}{{ $permission->permission_id }}" data-group="{{ $grp }}"   data-level="{{ $permission->level }}"  value="1">
                                    <label class="custom-control-label" for="permission{{ $role->role_id }}{{ $permission->permission_id }}"></label>
                                </div>
                             </td>
                             @endforeach
                          </tr>
                          @endforeach
                          @endforeach
                       </tbody>
                    </table>
                 </div>
                <div class="clearfix"></div>
                 <div class="mt-3">
                  <button type="submit" name="submitBtn" id="submitBtn" class="btn btn-primary float-right">Save</button>
                </div>
              </form>
            </div>
         </div>
      </div>
   </div>
   <!-- End Awaiting Approval List -->
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ url('public/panel/custom/permission/index.js') }}{{ Config::get('params.app_version') }}"></script>
@stop
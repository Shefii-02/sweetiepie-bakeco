
@extends('layouts.frontend')
@section('styles')

@endsection
@section('contents')
      
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 text-left">
                    <h1>Login & Security</h1>
                </div>
            </div>
        </div>
    </section>
    
    <section class="page_section">
        <div class="container">
           
            <div class="row justify-content-center">
                <div class="col-md-10 ">
                               
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"  class="mb-2">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('myaccount')}}">My Account</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login & Security</li>
                      </ol>
                    </nav>
                    
                    <div class="col-md-12">
                        <div class="row ">
                            <div class="col-lg-10 mb-2">
                                <div class="card border-Default mb-3">
                                    <div class=" text-dark fw-bold">
                                        <div class="col-lg-12 card-body">
                                            <div class="row position-relative align-items-center" >
                                                <div class="col-10">
                                                    <p>Email</p>
                                                    <p>{{$account->email}}</p>
                                                </div>
                                               <div class="col-2">
                                                    <button class="btn btn-light shadow btn-sm"  data-bs-toggle="modal" data-bs-target="#edit_phone">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-lg-12 card-body">
                                            <div class="row">
                                                <div class="col-10">
                                                    <p>Name</p>
                                                    <p>{{$account->name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <div class="col-lg-12 card-body">
                                            <div class="row">
                                                <div class="col-10">
                                                    <p>Phone</p>
                                                    <p>{{$account->phone}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-lg-12 card-body">
                                            <div class="row position-relative">
                                                <div class="col-10">
                                                    <p>Password</p>
                                                    <p>**********</p>
                                                </div>
                                                <div class="col-2">
                                                    <button class="btn btn-light shadow btn-sm"  data-bs-toggle="modal" data-bs-target="#edit_password">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
   
        <!-- Modal -->
    <div class="modal fade" id="edit_phone" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new_ModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="new_ModalLabel">Edit Phone Number</h5>
            <i class=" cursor-pointer fa fa-times text-dark fa-2x" data-bs-dismiss="modal" aria-label="Close"></i>
          </div>
          <div class="modal-body">
               
                <form action="{{url('myaccount/login-security')}}" class="row" novalidate id="profile_edit"  method="POST">
                    @csrf()
                    <div class="col-lg-12 form-group mb-2">
                      <label class="mb-2" for="">First Name</label>
                      <input type="text" autocomplete="off"  form="profile_edit" value="{{$account->firstname}}" class="form-control" name="firstname">
                    </div>
                    <div class="col-lg-12 form-group mb-2">
                      <label class="mb-2" for="">Last Name</label>
                      <input type="text" autocomplete="off"  form="profile_edit" value="{{$account->lastname}}" class="form-control" name="lastname">
                    </div>
                    <div class="col-lg-12 form-group mb-2">
                      <label class="mb-2" for="">Email Id</label>
                      <input type="email" autocomplete="off"  form="profile_edit" class="form-control" value="{{$account->email}}" name="email">
                    </div>
                    <div class="col-lg-12 form-group mb-2">
                      <label class="mb-2" for="">Phone Number</label>
                      <input type="text" autocomplete="off"  form="profile_edit" required value="{{$account->phone}}" class="form-control" name="phone">
                    </div>
                </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary swal2-styled swal2-cancel" data-bs-dismiss="modal">Close</button>
            <button type="submit" form="profile_edit"  class="swal2-confirm swal2-styled swal2-default-outline">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="edit_password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new_ModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="new_ModalLabel">Reset Password</h5>
                <i class=" cursor-pointer fa fa-times text-dark fa-2x" data-bs-dismiss="modal" aria-label="Close"></i>
              </div>
              <div class="modal-body">
                  <form action="{{url('myaccount/login-security/password-edit')}}" class="validated not-ajax" id="password_edit"  method="POST">
                        @csrf()
                        <div class="col-lg-12 form-group mb-2">
                          <label class="mb-2" for="password">Password</label>
                          <input type="password" autocomplete="off"  form="password_edit"  class="form-control" required id="password" name="password"> 
                          <small id="passwordError" class="text-danger"></small>
                        </div>
                        <div class="col-lg-12 form-group mb-2">
                          <label class="mb-2" for="confirm_password">Confirm Password</label>
                          <input type="password" autocomplete="off"  form="password_edit"  class="form-control" required id="confirm_password" name="confirm_password">
                          <small id="confirmError" class="text-danger"></small>
                        </div>
                     
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary swal2-styled swal2-cancel" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="password_edit"  class="swal2-confirm swal2-styled swal2-default-outline">Save</button>
              </div>
            </div>
        </div>
    </div>
@endsection    


@section('scripts')
<script>
    $(document).ready(function() {
        $('#confirm_password').on('input', function() {
            var password = $('#password').val();
            var confirmPassword = $(this).val();
            var passwordError = $('#passwordError');
            var confirmError = $('#confirmError');
            if(password.length <= confirmPassword.length){
                if (password !== confirmPassword) {
                    passwordError.text('Password and Confirm Password do not match');
                    confirmError.text('Password and Confirm Password do not match');
                } else {
                    passwordError.text('');
                    confirmError.text('');
                }
            }else {
                    passwordError.text('');
                    confirmError.text('');
                }
        });
        
        $('#password_edit').on('submit', function(event) {
            
            var password        = $('#password').val();
            var confirmPassword = $('#confirm_password').val();
            var passwordError   = $('#passwordError');
            var confirmError    = $('#confirmError');

            if (password !== confirmPassword) {
                passwordError.text('Password and Confirm Password do not match');
                confirmError.text('Password and Confirm Password do not match');
                event.preventDefault();
            }
        });
    });
</script>
@endsection
                 
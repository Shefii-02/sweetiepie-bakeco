
@extends('layouts.frontend')
@section('styles')
<style>
   .mybox .box {
        border-style: dashed;
        height: 180px;
        width: 320px;
        border-width: 2px;
        box-sizing: border-box;
        border-color: #C7C7C7;
        text-align: center;
        display: table-cell;
        vertical-align: middle;
        border-radius:7px;
        cursor:pointer;
    }

</style>
@endsection
@section('contents')
      
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 text-left">
         
                </div>
            </div>
        </div>
    </section>
    
    <section class=" pb-5 pt-5">
        <div class="container">
           
            <div class="row justify-content-center">
                <div class="col-md-10 ">
                               
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"  class="mb-2">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('myaccount')}}">My Account</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment Card List</li>
                      </ol>
                    </nav>
                    <div class="mb-4">
                        <h4>My Cards</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="row mybox">
                            <div class="col-lg-4 mb-2">
                                <div class="box " data-bs-toggle="modal" data-bs-target="#new_Modal">
                                  <i class="fa fa-plus fa-3x text-secondary mb-3"></i>
                                  <p class="h3">Add Card</p>
                                </div>
                            </div>
                            @foreach($mycard as $item)
                                <div class="col-lg-4 mb-2">
                                    <div class="card border-Default mb-3">
                                        <div class="card-body text-dark fw-bold">
                                           <div class="d-flex flex-column">
                                                <small>{{$item->name_on_card}}</small>
                                                <small>{{$item->card_no}}</small>
                                                <small>{{$item->card_exp_date}}</small>
                                                <small>{{$item->card_cvv}}</small>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent border-success">
                                            <ul class="list-unstyled pe-2 d-flex ">
                                                <li class="pe-2" ><small class="card_edit cursor-pointer" data-name="{{$item->name_on_card}}" data-number="{{$item->card_no}}"  data-id="{{$item->id}}" data-exp="{{$item->card_exp_date}}" data-cvv="{{$item->card_cvv}}" >Edit</small></li> 
                                                <li class="ps-1 pe-1">|</li>
                                                <li >
                                                    <form method="POST" action="{{route('card_delete',$item->id)}}" id="card_{{$item->id}}">
                                                        @csrf()
                                                        <small class="card_delete cursor-pointer"  data-id="card_{{$item->id}}">Delete</small>
                                                    </form>
                                                </li>
                                            </ul>    
                                        </div>
                                    </div> 
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <!-- Modal -->
    <div class="modal fade" id="new_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new_ModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="new_ModalLabel">Add Card</h5>
            <i class="btn-close fa fa-times text-dark fa-2x" data-bs-dismiss="modal" aria-label="Close"></i>
          </div>
          <div class="modal-body">
              <form action="{{url('myaccount/payment-options/add')}}" class="row" id="card_add" method="POST">
                  @csrf()
                  <div class="col-lg-12 form-group mb-2">
                      <label class="mb-2" for="">Card Number</label>
                      <input type="text" autocomplete="off"  required oninput="this.value = this.value.replace(/[^0-9]/g, '')" minlength="14"  maxlength="16" form="card_add" class="form-control" name="card_number">
                  </div>
                  
                  <div class="col-lg-12 form-group mb-2">
                      <label class="mb-2" for="">Full Name on Card</label>
                      <input type="text" autocomplete="off"  required form="card_add"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" class="form-control" name="card_name">
                  </div>
                 
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">Exp:Date</label>
                      <input type="text" autocomplete="off"  required  form="card_add" class="form-control card_exp" name="card_exp">
                  </div> 
                  
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">Security Code</label>
                      <input type="text" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9]/g, '')"  class="form-control" minlength="3" name="cvv">
                  </div>
                 
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" form="card_add"  class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="modal fade" id="edit_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new_ModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="new_ModalLabel">Edit Card</h5>
                <i class="btn-close fa fa-times text-dark fa-2x" data-bs-dismiss="modal" aria-label="Close"></i>
              </div>
              <div class="modal-body">
                  <form action="{{url('myaccount/payment-options/edit')}}" class="row" id="card_edit" method="POST">
                      @csrf()
                      <div class="col-lg-12 form-group mb-2">
                          <label class="mb-2" for="">Card Number</label>
                          <input type="hidden" name="id" id="id" required> 
                          <input type="text" autocomplete="off"  required oninput="this.value = this.value.replace(/[^0-9]/g, '')" minlength="14"  maxlength="16" form="card_edit" class="form-control" name="card_number" id="card_number">
                      </div>
                      
                      <div class="col-lg-12 form-group mb-2">
                          <label class="mb-2" for="">Full Name on Card</label>
                          <input type="text" autocomplete="off"  required form="card_edit"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" class="form-control" name="card_name" id="card_name">
                      </div>
                     
                      <div class="col-lg-6 form-group mb-2">
                          <label class="mb-2" for="">Exp:Date</label>
                          <input type="text" autocomplete="off"  required  form="card_edit" class="form-control card_exp" name="card_exp" id="card_exp">
                      </div> 
                      
                      <div class="col-lg-6 form-group mb-2">
                          <label class="mb-2" for="">Security Code</label>
                          <input type="text" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9]/g, '')"  class="form-control" minlength="3" name="cvv" id="cvv">
                      </div>
                     
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="card_edit"  class="btn btn-primary">Save</button>
              </div>
            </div>
        </div>
    </div>

@endsection    


@section('scripts')
<script>

    $('body').on('input', '.card_exp', function () {
        
        var value = $(this).val();
              // Remove non-digit characters
          value = value.replace(/\D/g, '');
    
          // Get the first two digits
          var firstTwoDigits = value.slice(0, 2);
    
          // Check if the first two digits exceed 12
          if (parseInt(firstTwoDigits) > 12) {
            // Adjust the value to maximum valid month
            value = '12' + value.slice(2);
          }
    
          // Format the value with a slash
          if (value.length > 2) {
            value = value.slice(0, 2) + '/' + value.slice(2, 4);
          }
          
          
        $(this).val(value);   
        
        
    });
    
    
        
    $('body').on('click', '.card_edit', function () {
        
        var name    = $(this).data('name');
        var number  = $(this).data('number');
        var id      = $(this).data('id');
        var exp     = $(this).data('exp');
        var cvv     = $(this).data('cvv');
        
        
        $('#card_number').val(number)
        $('#card_name').val(name)
        $('#id').val(id)
        $('#card_exp').val(exp)
        $('#cvv').val(cvv)
        
        $('#edit_Modal').modal('show')
    });
        
    
    $('body').on('click', '.card_delete', function () {
        $('#'+$(this).data('id')).submit();
    });
    
    



          

</script>
@endsection
                 
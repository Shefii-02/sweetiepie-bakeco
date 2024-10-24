@extends('layouts.frontend')
@section('contents')

<style>
    section.nutrition-explorer input{
        padding: 10px;
        border-radius: 30px;
        border: 2px solid var(--primary);
    }
    section.nutrition-explorer input:focus{
        outline: none;
    }
    section.nutrition-explorer button{
        border: none;
        background: var(--primary);
        border-radius: 30px;
        margin-left: -50px;
        padding: 0 25px;
}
    }
    section.nutrition-explorer button i{
        font-size: 22px;
        color: #fff;
    }
    section.cold-bevarges button.accordion-button{
        background: #fafafa;
        text-decoration: none;
    }
    section.cold-bevarges button.accordion-button:focus{
        box-shadow: none;
    }
    section.cold-bevarges button.accordion-button::after{
        position: absolute;
        left: 10px;
    }
    section.cold-bevarges button.accordion-button span{
        margin: 0 15px;
    }
    section.cold-bevarges button.accordion-button span img{
        width: 40px;
    }
     section.cold-bevarges .accordion-collapse{
         background: #fafafa;
     }
     .spinner.position-absolute {
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: #ffffff96;
}
.spinner-border {
    position: absolute;
    top: 50%;
    left: 50%;
}
[name="single_selection"]:checked + label {
    background: var(--primary);
    color: var(--bs-white);
}label.btn.btn-light.border-0.d-flex.align-items-center {
    width: 70px;
    border-radius: 50%;
    height: 70px;
}.option__type:checked + label {
    background: var(--primary);
    color: #fff !important;
}.nutrition-values:nth-child(odd) {
    background: var(--bs-light);
}.p-3.border-bottom.small.px-1 {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
}.d-flex.align-items-center.bg-light.rounded-circle {
    width: 70px;
    height: 70px;
    background: #f9dccd !important;
}.row.m-auto .col-xl-1:first-child {
    margin-left: auto;
}.row.m-auto .col-xl-1:last-child {
    margin-right: auto;
}
</style>

<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Nutrition Explorer</h1>
            </div>
        </div>
    </div>
</section>
<section class="nutrition-explorer pt-5 pb-5" style="min-height:400px">
     <div class="container">
        <div class="row">
           <div class="col-12">
                <h1 class="text-center fw-bold text-theme">Find a Menu Item</h1>
                <p class="text-center">Type in a menu item to find nutrition information and more.</p>

                <form action="{{ url('/nutrition-explorer') }}" method="post" class="d-flex nutri-form validated not-ajax" autocomplete="off">
                    @csrf
                    <input type="text" id="search" name="search" class="w-100 form-conrol shadow-none" placeholder="Search" autocomplete="off">
                    <button type="submit fs-5"><i class="bi bi-search text-white"></i></button>
                </form>


           </div>
           <div class="col-12 productsCol mt-5">
               <div class="products-list py-5 position-relative">
                   
               </div>
           </div>
        </div>
    </div>
</section>
<div class="modal fade" id="nutriModal" aria-hidden="true" aria-labelledby="nutriModalLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header border-0 position-relative">
        <div class="w-100 position-relative">
            <button type="button ms-auto" class="btn border-0 fs-2 position-absolute top-0 end-0" style="z-index:10000" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
      </div>
      <div class="modal-body border-0">
        <div class="container m-auto nutriContents">
            
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
$('.nutri-form').on('submit', function(e){
    e.preventDefault(); 
    let $form = $(this);
    $('.productsCol .products-list .spinner').remove();
    $('.productsCol .products-list').append(`<div class="spinner position-absolute"><div class="position-relative w-100 h-100"><div class="spinner-border" role="status">
  <span class="visually-hidden">Loading...</span>
</div></div></div>`);
    try{
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $('.productsCol').html(data.html)
            },
            error: function(data) {
                
            }
        });
    }catch(e){}
});
$(document).on('click', '.nutri-item', async function(e){
   e.preventDefault(); 
   $('.productsCol .products-list').append(`<div class="spinner position-absolute"><div class="position-relative w-100 h-100"><div class="spinner-border" role="status">
  <span class="visually-hidden">Loading...</span>
</div></div></div>`);
   await $.getJSON($(this).attr('href'), function(response) {
        $('.nutriContents').html(response.html);
        $('#nutriModal').modal('show');
        loadNutri();
    });
    $('.productsCol .products-list .spinner').remove();
    
});
</script>
<script>

    const loadVariants = function(){
        $('.variants').hide();
        $('[name="single_selection"]:checked').closest('.d-flex').find('.variants').show();
        loadNutri();
    }
    $(loadVariants);
    $(document).on('click', '[name="single_selection"]', function(){
        console.log(true);
    $(this).closest('.d-flex').find('.option__type').first().prop('checked', true).attr('checked', true);
    loadVariants();
});
$(document).on('click', '.option__type', function(){
    loadNutri();
})
const loadNutri = function(){
    let cls = $('.option__type:checked').attr('id');
    $('.nutritionDetails').hide();
    $(`.${cls}`).show();
}
</script>
@endsection
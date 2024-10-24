@extends('layouts.frontend')

@section('contents')
    <style>
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
                    <h1 >{{titleText($products->name)}}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="py-5">
        @include('frontend/single-product-nutrition-contents')
    </div>
     
@endsection
@section('scripts')
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

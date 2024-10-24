@extends('layouts.frontend')

@section('contents')
    
<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Media</h1>
            </div>
        </div>
    </div>
</section>


<main class="pt-5 pb-5">
  <div class="container">
    <section class="gallery gallery-media">
      <!-- Assuming $gallery is a valid array/collection of image items. -->
      @foreach($gallery as $key => $items)
      <div class="image pop cursor-pointer">
        <img src="{!!$items->picture != '' ? asset('images/gallery/'.$items->picture) : asset('dummy.jpg')!!}"
          alt="image" id="gallery-item-{{$key}}" />
          
        <div class="caption d-none">
          <h3>{{$items->title}}</h3>
          <!-- Add the share button here (replace 'your-image-url' with the actual image URL). -->
          <button class="btn-share" data-image-url="{!!$items->picture != '' ? asset('images/gallery/'.$items->picture) : asset('dummy.jpg')!!}">
            Share
          </button>
        </div>
      </div>
      @endforeach
    </section>
  </div>
</main>

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center">
      <div class="modal-content">
        <div class="modal-body" id="gallery-image">
          <a class="arrow-next slider-previous gallery-nav" href="#" style="position:absolute;">
            <i class="fa fa-angle-left"></i>
          </a>
          <img src="" class="imagepreview" id="imgsrc" style="width: 100%;" data-image-id="">
          <div class="image-caption text-center mt-2">
            <h6 class="text-capitalize caption-title"></h6>
            <!-- Share button in the modal. -->
            <!-- ShareThis BEGIN -->
                <div class="sharethis-inline-share-buttons"></div>
            <!-- ShareThis END -->
          </div>
          <a class="arrow-pre slider-next gallery-nav" href="#" style="position:absolute;">
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@section('scripts')
<script type="text/javascript">
    // Function to create ShareThis inline share buttons with a custom link
    function createInlineShareButtons(customLink) {
        var shareButtonsContainer = document.querySelector('.sharethis-inline-share-buttons');
        if (shareButtonsContainer) {
            shareButtonsContainer.innerHTML = ''; // Clear any existing buttons

            var shareConfig = {
                url: customLink,
                title: 'Check out this custom link!',
                // You can also specify a custom image for the share
                // image: 'https://www.example.com/custom-image.jpg'
            };

            // Create the share buttons using the ShareThis API
            SHARETHIS.inlineShareButtons(shareConfig);
        }
    }

    // Call the function to create the ShareThis inline share buttons with the custom link
    createInlineShareButtons('https://www.example.com/custom-link');
</script>
<script>

  $(document).ready(function () {
    var galleryItems = $(".gallery .image");
    var imagePreview = $("#imgsrc");
    var captionTitle = $(".caption-title");
    var captionText = $(".caption-text");
    var shareButtonModal = $(".btn-share-modal");
    var prevButton = $(".slider-previous");
    var nextButton = $(".slider-next");
    var currentIndex = 0;

    // Show the clicked image in the modal
    galleryItems.on("click", function () {
      currentIndex = galleryItems.index(this);
      var imgSrc = $(this).find("img").attr("src");
      var caption = $(this).find(".caption");
      var captionTitleText = caption.find("h3").text();
      var captionTextText = caption.find("p").text();

      imagePreview.attr("src", imgSrc);
      captionTitle.text(captionTitleText);
      captionText.text(captionTextText);
      $("#imagemodal").modal("show");
    });

    // Hide the modal when the background is clicked
    $("#imagemodal").on("click", function (event) {
      if (event.target === this) {
        $(this).modal("hide");
      }
    });

    // Previous image navigation
    prevButton.on("click", function (e) {
      e.stopPropagation();
      currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
      updateModalContent();
    });

    // Next image navigation
    nextButton.on("click", function (e) {
      e.stopPropagation();
      currentIndex = (currentIndex + 1) % galleryItems.length;
      updateModalContent();
    });

    // Update the modal content (image, caption) based on the current index
    function updateModalContent() {
      var item = galleryItems.eq(currentIndex);
      var imgSrc = item.find("img").attr("src");
      var caption = item.find(".caption");
      var captionTitleText = caption.find("h3").text();
      var captionTextText = caption.find("p").text();

      imagePreview.attr("src", imgSrc);
      captionTitle.text(captionTitleText);
      captionText.text(captionTextText);
    }

    // Share button click event in the modal
    shareButtonModal.on("click", function () {
      var imageUrl = imagePreview.attr("src");
      // Add your custom share functionality here, e.g., opening a new window with the image URL.
      console.log("Sharing image: " + imageUrl);
      // Example: window.open(imageUrl);
    });
  });
</script>
@endsection
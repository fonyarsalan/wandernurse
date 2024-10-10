if (window.matchMedia("(min-width: 576px)").matches) {
  
  var carousels = document.querySelectorAll('#carouselExampleIndicators'); // Get all carousels
console.log(carousels);
  carousels.forEach(function(carousel) {

    var carouselInner = carousel.querySelector('.carousel-inner');
    var carouselItems = carousel.querySelectorAll('.carousel-item');
    var cardWidth = carouselItems[0].offsetWidth;  // Get width of a single card
    var scrollPosition = 0;
    var carouselWidth = carouselInner.scrollWidth; // Carousel inner width

    // Function to smoothly scroll the carousel
    function smoothScroll(element, targetPosition, duration) {
      var startPosition = element.scrollLeft;
      var distance = targetPosition - startPosition;
      var startTime = null;

      function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        var timeElapsed = currentTime - startTime;
        var run = ease(timeElapsed, startPosition, distance, duration);
        element.scrollLeft = run;
        if (timeElapsed < duration) requestAnimationFrame(animation);
      }

      // Easing function for a smooth scroll effect
      function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t--;
        return -c / 2 * (t * (t - 2) - 1) + b;
      }

      requestAnimationFrame(animation);
    }

    // Handle next button click
    carousel.querySelector('.carousel-control-next').addEventListener('click', function () {
      if (scrollPosition < (carouselWidth - cardWidth * 4)) {
        scrollPosition += cardWidth;
        smoothScroll(carouselInner, scrollPosition, 600);  // 600ms duration
      }
    });

    // Handle previous button click
    carousel.querySelector('.carousel-control-prev').addEventListener('click', function () {
      if (scrollPosition > 0) {
        scrollPosition -= cardWidth;
        smoothScroll(carouselInner, scrollPosition, 600);  // 600ms duration
      }
    });

  });

} else {
  var carousel = document.querySelectorAll('#carouselExampleIndicators');
  console.log(carousel);
  carousel.forEach(function(item) {
    item.classList.add('slide');
  });
  var carousels = document.querySelectorAll('#carouselExampleIndicators'); // Get all carousels
  console.log(carousels);
    carousels.forEach(function(carousel) {
  
      var carouselInner = carousel.querySelector('.carousel-inner');
      var carouselItems = carousel.querySelectorAll('.carousel-item');
      var cardWidth = carouselItems[0].offsetWidth;  // Get width of a single card
      var scrollPosition = 0;
      var carouselWidth = carouselInner.scrollWidth; // Carousel inner width
  
      // Function to smoothly scroll the carousel
      function smoothScroll(element, targetPosition, duration) {
        var startPosition = element.scrollLeft;
        var distance = targetPosition - startPosition;
        var startTime = null;
  
        function animation(currentTime) {
          if (startTime === null) startTime = currentTime;
          var timeElapsed = currentTime - startTime;
          var run = ease(timeElapsed, startPosition, distance, duration);
          element.scrollLeft = run;
          if (timeElapsed < duration) requestAnimationFrame(animation);
        }
  
        // Easing function for a smooth scroll effect
        function ease(t, b, c, d) {
          t /= d / 2;
          if (t < 1) return c / 2 * t * t + b;
          t--;
          return -c / 2 * (t * (t - 2) - 1) + b;
        }
  
        requestAnimationFrame(animation);
      }
  
      // Handle next button click
      carousel.querySelector('.carousel-control-next').addEventListener('click', function () {
        if (scrollPosition < (carouselWidth - cardWidth * 4)) {
          scrollPosition += cardWidth;
          smoothScroll(carouselInner, scrollPosition, 600);  // 600ms duration
        }
      });
  
      // Handle previous button click
      carousel.querySelector('.carousel-control-prev').addEventListener('click', function () {
        if (scrollPosition > 0) {
          scrollPosition -= cardWidth;
          smoothScroll(carouselInner, scrollPosition, 600);  // 600ms duration
        }
      });
  
});
}
var carousel = document.querySelectorAll('#carouselExampleIndicators');

carousel.forEach(function(item) {
  if (!item.classList.contains('pointer-event')){
    item.classList.add('pointer-event');
  }
});
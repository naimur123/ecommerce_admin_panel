// home cards
var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    autoplay: {
        delay: 5000,
    },
    breakpoints: {
        800: {
            slidesPerView: 5,
        },
        700: {
            slidesPerView: 3,
        },
        650:{
            slidesPerView: 1,
        }
    },
    speed: 800,
   
});
// end
// home brands
var swiper = new Swiper(".mySwiperBrand", {
    spaceBetween: 10,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    autoplay: {
        delay: 5000,
    },
    breakpoints: {
        800: {
            slidesPerView: 8,
        },
        700: {
            slidesPerView: 6,
        },
        650:{
            slidesPerView: 4,
        }
    },
    speed: 800,
   
});
// end

// slider
var swiperSlider = new Swiper(".mySwiperSlider", {
    slidesPerView: 1,
    spaceBetween: 30,
    autoplay: {
        delay: 3000,
    },
    speed: 800,
});
// end


// product details
var swiper = new Swiper(".productDetailsImg", {
    effect: "creative",
    rewind: true,
    grabCursor: true,
    creativeEffect: {
        prev: {
          translate: [0, 0, -400],
        },
        next: {
          translate: ["100%", 0, 0],
        },
      },
    autoplay:{
        delay: 3000,
    }
});
// end




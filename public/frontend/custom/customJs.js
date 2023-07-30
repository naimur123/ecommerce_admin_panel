// home cards
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    autoplay: {
        delay: 5000,
    },
    breakpoints: {
        991: {
            slidesPerView: 4,
        },
        767: {
            slidesPerView: 2,
        },
    },
   
});

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
    // effect: "coverflow",
    // grabCursor: true,
    // centeredSlides: true,
    // slidesPerView: "auto",
    // coverflowEffect: {
    //     rotate: 40,
    //     stretch: 0,
    //     depth: 100,
    //     modifier: 1,
    //     slideShadows: false,
    // },
    // autoplay:{
    //     delay: 3000,
    // }
    effect: "cards",
    rewind: true,
    grabCursor: true,
    autoplay:{
        delay: 3000,
    }
});
// end
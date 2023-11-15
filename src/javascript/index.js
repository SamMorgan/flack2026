import '../sass/styles.scss'; 

import imagesLoaded from 'imagesloaded';
import Swup from 'swup';
import SwupBodyClassPlugin from "@swup/body-class-plugin";
import SwupGaPlugin from '@swup/ga-plugin';
//import SwupFragmentPlugin, { Rule as FragmentRule } from "@swup/fragment-plugin";
import Swiper from 'swiper';
import { EffectFade, Navigation, Pagination, Autoplay } from 'swiper/modules';


// function fadeinImags() {
//   let imgWraps = document.querySelectorAll('.imgwrap');
//   for (var i = 0; i < imgWraps.length; i++) {
//     let imgWrap = imgWraps[i];
//     imagesLoaded(imgWraps[i], function () {
//       imgWrap.classList.add('img-ready');
//     });
//   }
// }

// Video
// ref: https://blog.teamtreehouse.com/building-custom-controls-for-html5-videos
let video = false;
let seekBar = false;
function setupVideo() {
  video = document.getElementById("video");
  seekBar = document.getElementById("seek-bar");
  let seekBarLine = document.getElementById("seek-bar");
  if (video && seekBar) {
    video.addEventListener("timeupdate", updateCountdown);
    // Event listener for the seek bar
    seekBar.addEventListener("change", function () {
      // Calculate the new time
      let time = video.duration * (seekBar.value / 100);
      seekBarLine.style.width = 100 - time + "%";

      // Update the video time
      video.currentTime = time;
    });
    // Pause the video when the slider handle is being dragged
    seekBar.addEventListener("mousedown", function () {
      video.pause();
    });

    // Play the video when the slider handle is dropped
    seekBar.addEventListener("mouseup", function () {
      video.play();
    });

    // video.addEventListener( "loadedmetadata", function () {
    //     //let ratio = video.videoHeight/video.videoWidth*100
    //     //video.parentElement.style.paddingBottom = ratio + "%"
    //     video.parentElement.classList.add('loaded')
    // }, false );
  }
}
function stopVideo() {
  if (video && video.playing) {
    video.stop();
  }
}
function pad2(number) {
  return (number < 10 ? "0" : "") + number;
}
function updateCountdown() {
  let timeSpan = document.querySelector("#countdown");
  let seekBar = document.getElementById("seek-bar");
  let seekBarLine = document.getElementById("seek-bar-line");
  let time = video.duration - video.currentTime;
  let minutes = pad2(Math.floor(time / 60));
  let seconds = pad2(Math.floor(time - minutes * 60));
  timeSpan.innerText = minutes + ":" + seconds;

  // seekbar
  let value = (100 / video.duration) * video.currentTime;
  seekBar.value = value;
  seekBarLine.style.width = 100 - value + "%";
}

// function setUphomeVideo() {
//   let homewrap = document.getElementById("home");

//   // if(homewrap){
//   //     video.addEventListener( "loadedmetadata", function () {
//   //         let ratio = video.videoHeight/video.videoWidth*100
//   //         video.parentElement.style.paddingBottom = ratio + "%"
//   //     }, false );
//   // }

//   video.parentElement.style.opacity = 0;

//   video.oncanplaythrough = function () {
//     video.parentElement.style.opacity = 1;
//   };
// }
function pagesLayout() {
  let pageWrap = document.querySelector(".page-wrap");
  if (pageWrap) {
    if (pageWrap.clientHeight > window.innerHeight) {
      pageWrap.classList.add("tall");
    } else {
      pageWrap.classList.remove("tall");
    }
  }
}
//pagesLayout();

// function peopleTitle() {
//   let people_title = document.getElementById("people-title");
//   let person = document.querySelector(".person");
//   if (people_title && person) {
//     let h = person.clientHeight;
//     if (h < window.innerHeight) {
//       console.log(h, window.innerHeight);
//       people_title.style.bottom = window.innerHeight - h + "px";
//     } else {
//       people_title.style.bottom = "2.5em";
//     }
//     people_title.style.opacity = 1;
//   }
// }
// //peopleTitle();

function visibleY(el) {
  var rect = el.getBoundingClientRect(),
    top = rect.top,
    height = rect.height,
    el = el.parentNode

  // Check if bottom of the element is off the page
  if (rect.bottom < 0) return false
  // Check its within the document viewport
  if (top >= document.documentElement.clientHeight) return false
  do {
    rect = el.getBoundingClientRect()
    if (top <= rect.bottom === false) return false
    // Check if the element is out of view due to a container scrolling
    if ((top + height) <= rect.top) return false
    el = el.parentNode
  } while (el != document.body)
  return true
}

function updateSlideCounter() {
  if (document.getElementById('project-slider')) {
    let projectImgs = document.querySelectorAll('.project-img');
    for (var i = 0; i < projectImgs.length; i++) {
      if (visibleY(projectImgs[i])) {
        let counterText = projectImgs[i].querySelector('img').dataset.index;
        if (projectImgs[i].clientWidth < (window.innerWidth * 0.5)) {
          counterText = projectImgs[i].closest('.project-image-wrap').dataset.counter;
        }
        document.getElementById('counter').innerHTML = counterText;
      }
    }
  }
}

// const intro = document.querySelector('.intro');  
// const closeIntro = () => {
//   const t = 400
//   intro.style.transition = `transform ${t}ms`
//   intro.style.transform = 'translateY(-100%)'
//   setTimeout(()=>{
//     intro.remove()
//   },t)
// }
// if (intro && sessionStorage.getItem('intro-seen') !== 'true') {
//     var nextPopup = sessionStorage.getItem( 'intro-seen' );

//     if (nextPopup < new Date()) {

//         intro.style.display = "block";

//         const introTimeout = setTimeout(() => {
//           closeIntro()
//         }, 1500);

//         intro.addEventListener('click',()=>{
//             var expires = new Date();
//             expires = expires.setHours(expires.getHours() + 24);
//             sessionStorage.setItem( 'intro-seen', expires );
//             clearTimeout(introTimeout);
//             closeIntro()
//         });
        
//     }	
// }


class SiteIntro extends HTMLElement {
  constructor() {
      super();
  }
  connectedCallback(){
    const t = 800
    const closeIntro = () => {
      const intro = this
      intro.style.transition = `transform ${t}ms`
      intro.style.transform = 'translateY(-100%)'
      setTimeout(()=>{
        intro.remove()
        var expires = new Date();
        expires = expires.setHours(expires.getHours() + 24);
        sessionStorage.setItem( 'intro-seen', expires );
      },t)
    }
    if (sessionStorage.getItem('intro-seen') !== 'true') {
      var nextPopup = sessionStorage.getItem( 'intro-seen' );
  
      if (nextPopup < new Date()) {
  
          this.style.display = "block";
  
          const introTimeout = setTimeout(() => {
            closeIntro()
          }, 2500);
  
          this.addEventListener('click',()=>{
              clearTimeout(introTimeout);
              closeIntro()
          });
          
      }	
    }
  }
}
window.customElements.define('site-intro', SiteIntro) 



class LazyImg extends HTMLElement {
  constructor() {
      super();
  }
  connectedCallback() {
      this.imgLoaded(this.querySelector('img'))
          .then(() => {
              this.classList.add('loaded')
          })
          .catch(error => {
              this.classList.add('error')
          })
  }
  imgLoaded = (img) => {
      return new Promise((resolve, reject) => {
          const image = new Image();
          image.src = img.src;
          image.onload = () => resolve(img);
          //image.onerror = () => reject(new Error(`Failed to load image: ${img.src}`));
      });
  }
}
window.customElements.define('lazy-img', LazyImg)



class HomeSlider extends HTMLElement {
  constructor() {
      super();
  }
  connectedCallback(){

      let slider = new Swiper(this, {
        modules: [EffectFade, Autoplay, Pagination],
        speed: 600,
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        },
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: true,
          //pauseOnMouseEnter: true
        },
        lazy: {
          loadPrevNext: true,
        },
        pagination: {
          el: ".swiper-pagination",
          type: "fraction",
        },
        // navigation: {
        //   nextEl: ".swiper-button-next",
        //   prevEl: ".swiper-button-prev",
        // }
      })
      this.querySelectorAll('.swiper-button-prev').forEach((prevBtn)=>{
        prevBtn.addEventListener('click',()=>{
          slider.slidePrev()
        })
      })
      this.querySelectorAll('.swiper-button-next').forEach((nextBtn)=>{
        nextBtn.addEventListener('click',()=>{
          slider.slideNext()
        })
      })

      if(!sessionStorage.getItem('intro-seen')){
        slider.autoplay.stop()
        setTimeout(()=>{
          slider.autoplay.start()
        },3300)
      }

      this.querySelectorAll('.imgwrap').forEach(img => {
        img.addEventListener('mouseover',()=>{
          document.body.classList.add('homeimg-hovering')
          slider.autoplay.stop()
        })
        img.addEventListener('mouseout',()=>{
          document.body.classList.remove('homeimg-hovering')
          slider.autoplay.start()
        })
      })
  }
  disconnectedCallback() {
    document.body.classList.remove('homeimg-hovering')
  }
}
window.customElements.define('home-slider', HomeSlider) 


// class HomeImg extends HTMLElement {
//   constructor() {
//     super();
//   }
//   connectedCallback(){
//     this.addEventListener('mouseover',()=>{
//       document.body.classList.add('homeimg-hovering')
//     })
//     this.addEventListener('mouseout',()=>{
//       document.body.classList.remove('homeimg-hovering')
//     })
//   }
//   disconnectedCallback() {
//     document.body.classList.remove('homeimg-hovering')
//   }
// }
// window.customElements.define('home-img', HomeImg) 


class HomeMarquee extends HTMLElement {
  constructor() {
      super();
  }
  setSpeed(){
    const marqueeEl = this.querySelector('div')
    const marqueeElCln = marqueeEl.cloneNode(true)
    const speed = window.innerWidth > 750 ? Math.max(Math.round(window.innerWidth * 20),20000) : 30000
    this.style.setProperty('--speed', speed + 'ms');
    marqueeEl.remove()
    this.appendChild(marqueeElCln)
  }
  connectedCallback(){
    this.setSpeed()
    window.addEventListener('resize',this.setSpeed.bind(this))
  }
  disconnectedCallback() {
    window.removeEventListener('resize',this.setSpeed)
  }
}
window.customElements.define('home-marquee', HomeMarquee) 


// window.addEventListener("resize", function () {
//   pagesLayout();
//   //peopleTitle();
//   updateSlideCounter();
// });
//

function throttle(callback, limit) {

  var wait = false;
  return function () {
    if (!wait) {

      callback.apply(null, arguments);
      wait = true;
      setTimeout(function () {
        wait = false;
      }, limit);
    }
  }
}


//// Custom Cursor //
//const customCursor = document.getElementById('cursor');
//var dir = 0,
//  oldx = 0,
//  oldy = 0,
//  arrow = customCursor.querySelector('svg'),
//  mousedirection = (e) => {

//    let a = Math.atan2(e.pageY - oldy, e.pageX - oldx) * 180 / Math.PI;
//    arrow.style.transform = 'rotate(' + a + 'deg)';
//    // if (a > -22.5 && a < 22.5) {
//    //   dir = "left";
//    // } else if (a > 22.5 && a < 67.5) {
//    //   dir = "left down";
//    // } else if (a > 67.5 && a < 112.5) {
//    //   dir = "down";
//    // } else if (a > 112.5 && a < 157.5) {
//    //   dir = "right down";
//    // } else if (a > 157.5 && a > -157.5) {
//    //   dir = "right";
//    // } else if (a > -157.5 && a < -112.5) {
//    //   dir = "right up";
//    // } else if (a > -112.5 && a < -67.5) {
//    //   dir = "up";
//    // } else if (a > -67.5 && a < -22.5) {
//    //   dir = "left up";
//    // } else {
//    //   dir = "left up";
//    // }

//    oldx = e.pageX;
//    oldy = e.pageY;
//    //console.log(a, dir);
//    customCursor.setAttribute("class", dir);
//  }

//window.addEventListener('wheel', function (event) {
//  if (event.deltaY < 0) {
//    //customCursor.setAttribute("class", "up");
//    arrow.style.transform = 'rotate(-90deg)';
//  }
//  else if (event.deltaY > 0) {
//    //customCursor.setAttribute("class", "down");
//    arrow.style.transform = 'rotate(90deg)';
//  }
//});


//// set the starting position of the cursor outside of the screen
//let clientX = -100;
//let clientY = -100;

//const initCursor = () => {

//  document.addEventListener("mousemove", e => {
//    clientX = e.clientX;
//    clientY = e.clientY;
//    customCursor.style.transform = `translate(${clientX}px, ${clientY}px)`;
//  });
//  //const render = () => {
//  //customCursor.style.transform = `translate(${clientX}px, ${clientY}px)`;

//  //   requestAnimationFrame(render);
//  // };
//  // requestAnimationFrame(render);
//};


function is_touch_device() {
 return (('ontouchstart' in window)
   || (navigator.MaxTouchPoints > 0)
   || (navigator.msMaxTouchPoints > 0));
}

//function customCursorHoverState() {
//  var anchor = document.querySelectorAll('a,button,.button');
//  if (anchor.length > 0) {
//    for (var i = 0; i < anchor.length; i++) {
//      anchor[i].addEventListener('mouseover', function () {
//        customCursor.setAttribute("data-hover", "button");
//      });
//      anchor[i].addEventListener('mouseout', function () {
//        customCursor.removeAttribute("data-hover");
//      });
//    }
//  }
//  var input = document.querySelectorAll('input');
//  if (input.length > 0) {
//    for (var i = 0; i < input.length; i++) {
//      input[i].addEventListener('mouseover', function () {
//        customCursor.setAttribute("data-hover", "input");
//      });
//      input[i].addEventListener('mouseout', function () {
//        customCursor.removeAttribute("data-hover");
//      });
//    }
//  }
//  var overlaySlider = document.querySelector('.overlay-slider');
//  if (overlaySlider) {
//    overlaySlider.addEventListener('mouseover', function () {
//      customCursor.setAttribute("data-hover", "close");
//    });
//    overlaySlider.addEventListener('mouseout', function () {
//      customCursor.removeAttribute("data-hover");
//    });
//  }
//}
////customCursorHoverState();

//if (customCursor) {
//  document.addEventListener('mousemove', throttle(e => { mousedirection(e) }, 100));
//  initCursor();
//  //customCursorHoverState();
//}

//document.body.addEventListener('mouseout', function (e) {
//  if (!e.relatedTarget && !e.toElement) {
//    customCursor.style.display = "none";
//  } else {
//    customCursor.style.display = "block";
//  }
//});

//document.body.addEventListener('mouseleave', function (e) {
//  //if (!e.relatedTarget && !e.toElement) {
//  customCursor.style.display = "none";
//  //}
//  //  else {
//  //   customCursor.style.display = "block";
//  // }
//});

//document.body.addEventListener('mouseenter', function (e) {
//  //if (!e.relatedTarget && !e.toElement) {
//  customCursor.style.display = "block";
//  //}
//  //  else {
//  //   customCursor.style.display = "block";
//  // }
//});

const toggleMenu = document.querySelector(".toggle-menu");
toggleMenu.addEventListener('click', function () {
  //document.body.classList.add("menu-open");
  if(document.body.classList.contains("menu-open")){
    document.body.classList.remove("menu-open")
    //toggleMenu.innerText = "Menu"
  }else{
    document.body.classList.add("menu-open")
    //toggleMenu.innerText = "Close"      
  }
});


document.querySelector('.close-menu').addEventListener('click',() => {
    document.body.classList.remove("menu-open")
});


let lastScroll = 0;
const siteHeader = document.querySelector('.site-header');
const main = document.querySelector('main')
const headerUpDown = () => {
    const currentScroll = main.scrollTop;
    //const siteHeader = document.querySelector('.site-header');
    if (currentScroll <= 0) {
      siteHeader.classList.remove('scrolled-up');
      return;
    }

    if (currentScroll > lastScroll && !siteHeader.classList.contains('scrolled-down')) {
      // down
      siteHeader.classList.remove('scrolled-up');
      siteHeader.classList.add('scrolled-down');
    } else if (
      currentScroll < lastScroll &&
      siteHeader.classList.contains('scrolled-down')
    ) {
      // up
      siteHeader.classList.remove('scrolled-down');
      siteHeader.classList.add('scrolled-up');
    }
    lastScroll = currentScroll;   

}

function init() {

  let headerScrollAdded = true
  const mainWrap = document.querySelector('.main-wrap')
  main.addEventListener("scroll", headerUpDown)
  if(mainWrap.scrollHeight <= window.innerHeight){
      main.removeEventListener("scroll", headerUpDown)
      headerScrollAdded = false
      siteHeader.classList.remove('scrolled-down');
  }


  window.addEventListener('resize',()=>{
      if(mainWrap.scrollHeight <= window.innerHeight){
          if(headerScrollAdded){
              main.removeEventListener("scroll", headerUpDown)
              headerScrollAdded = false
          }
      }else{
          if(!headerScrollAdded){
              main.addEventListener("scroll", headerUpDown)
              headerScrollAdded = true
          }    
      }        
  })

  //fadeinImags();
  // if (document.querySelector(".projects-slider")) {
  //   var swiper = new Swiper('.projects-slider', {
  //     //init: false,
  //     preloadImages: true,

  //     // lazy: {
  //     //   loadPrevNext: true
  //     // },
  //     //loop: true,
  //     effect: 'fade',
  //     pagination: {
  //       el: '.swiper-pagination',
  //       type: 'custom',
  //       renderCustom: function (swiper, current, total) {
  //         return current;
  //       }
  //     },
  //     navigation: {
  //       nextEl: '.swiper-button-next',
  //       prevEl: '.swiper-button-prev'
  //     },
  //     keyboard: {
  //       enabled: true
  //     }
  //   });
  // }
  //if (customCursor && !is_touch_device()) {
  //  //customCursorHoverState();

  //  document.addEventListener('mousemove', function () {
  //    customCursorHoverState();
  //  });
  //}


  //const mainMenu = document.getElementById("main-menu");
  // function closeMenu() {
  //     document.body.classList.remove('menu-open')
  //     setTimeout(function(){
  //         document.removeEventListener('click',closeMenu)
  //     },500);
  // }

  // toggleMenu.addEventListener('click',function(){
  //     document.body.classList.add('menu-open')
  //     setTimeout(function(){
  //         document.addEventListener('click',closeMenu)
  //     },500);
  // })
  // toggleMenu.addEventListener('click', function () {
  //   document.body.classList.add('menu-open')
  //   setTimeout(function () {
  //     document.addEventListener('click', closeMenu)
  //   }, 500);
  // });
  // Intro
  // const intro = document.getElementById("intro");
  // if (intro) {
  //   document.body.classList.add('acknowledgement-open');
  //   if (navigator.cookieEnabled) {
  //     // if ("ontouchstart" in document.documentElement) {
  //     //   document.getElementById("make-a-booking").addEventListener("click", function () {
  //     //     document.body.classList.add("intro-open");
  //     //   });

  //     //   // document.getElementById("intro-nav").addEventListener("click", function () {
  //     //   //   document.body.classList.remove("intro-open");
  //     //   // });
  //     // } else {
  //     //   document.getElementById("make-a-booking").addEventListener("mouseenter", function () {
  //     //     document.body.classList.add("intro-open");
  //     //   });

  //     //   document.getElementById("intro-nav").addEventListener("mouseleave", function () {
  //     //     document.body.classList.remove("intro-open");
  //     //   });
  //     // }

  //     document.getElementById("enter-site").addEventListener("click", function () {
  //       intro.style.opacity = "0";
  //       document.body.classList.remove('acknowledgement-open')
  //       setTimeout(function () {
  //         intro.parentNode.removeChild(intro);
  //       }, 1000);

  //       document.documentElement.classList.add("is-changing");
  //       setTimeout(function () {
  //         document.documentElement.classList.remove("is-changing");
  //       }, 1000);

  //       //document.cookie = "flack_visitor=1";
  //       setCookie("flack_visitor", 1, 365);
  //     });
  //   } else {
  //     intro.parentNode.removeChild(intro);
  //   }
  // }

  // function openMenu() {
  //   if (document.documentElement.className.indexOf("is-changing") == -1) {
  //     document.body.classList.add("menu-open");
  //   }
  // }
  // mainMenu.addEventListener("mouseenter", openMenu);

  // mainMenu.addEventListener("mouseleave", function () {
  //   document.body.classList.remove("menu-open");
  // });
  // hoverintent(mainMenu,
  //   function () {
  //     openMenu();
  //   }, function () {
  //     document.body.classList.remove("menu-open");
  //   });

  //if (is_touch_device()) {

  //}  

  // document
  //   .querySelector(".main-nav ul li:not(.current-menu-item) a")
  //   .addEventListener("click", function () {
  //     //console.log('b')
  //     mainMenu.addEventListener("mouseenter", openMenu);
  //   });

  //let menuBtnTxt = "Menu";
  // if (document.querySelector("#site-header li[class*=current-]")) {
  //   let curr = document.querySelector("#site-header li[class*=current-]");
  //   menuBtnTxt =
  //     curr.parentElement.previousElementSibling.textContent +
  //     " — " +
  //     curr.textContent;

  // }
  // toggleMenu.innerHTML = menuBtnTxt;

  function projectGallery() {
    let thumbs = document.querySelectorAll('.thumbnails .thumb img');
    if (thumbs) {
      for (var i = 0; i < thumbs.length; i++) {
        thumbs[i].addEventListener('click', function () {
          let nodes = Array.prototype.slice.call(document.querySelector('.thumbnails ul').children);
          let index = nodes.indexOf(this.closest('li'));
          //let s = document.querySelectorAll('.project-image')[index].offsetTop;
          let s = document.querySelector(".project-image-wrap img[data-index='" + (index + 1) + "']").closest('.project-image-wrap').offsetTop;
          //console.log(index, s);
          document.querySelector('.projects-slider').scrollTo(0, s);
          document.querySelector('.project-wrap').classList.remove('thumbs-open');
        });
      }
    }
  }

  let showArtistsImg = document.querySelectorAll('.show-artist-maker-images');
  let hideArtistsImg = document.querySelectorAll('.hide-artist-maker-images');
  if (showArtistsImg && hideArtistsImg) {
    for (var i = 0; i < showArtistsImg.length; i++) {
      showArtistsImg[i].addEventListener('click', function () {
        document.querySelector('.artist-and-makers-wrap').classList.toggle('slider-open');
      });

      // hover state
      if (!is_touch_device()) {
        showArtistsImg[i].addEventListener('mouseover', function () {
          for (var i = 0; i < showArtistsImg.length; i++) {
            showArtistsImg[i].classList.add('hover');
          }
        });
        showArtistsImg[i].addEventListener('mouseout', function () {
          for (var i = 0; i < showArtistsImg.length; i++) {
            showArtistsImg[i].classList.remove('hover');
          }
        });
      }
    }

    for (var i = 0; i < hideArtistsImg.length; i++) {
      hideArtistsImg[i].addEventListener('click', function () {
        document.querySelector('.artist-and-makers-wrap').classList.remove('slider-open');
      });

      // hover state
      if (!is_touch_device()) {
        hideArtistsImg[i].addEventListener('mouseover', function () {
          for (var i = 0; i < hideArtistsImg.length; i++) {
            hideArtistsImg[i].classList.add('hover');
          }
        });
        hideArtistsImg[i].addEventListener('mouseout', function () {
          for (var i = 0; i < hideArtistsImg.length; i++) {
            hideArtistsImg[i].classList.remove('hover');
          }
        });
      }
    }
  }

  let openGallery = document.querySelectorAll('a[href="#gallery"]');
  if (openGallery) {
    for (var i = 0; i < openGallery.length; i++) {
      openGallery[i].addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('.page-wrap').classList.add('slider-open');
      });
    }
  }
  let closeGallery = document.querySelectorAll('.close-gallery');
  if (closeGallery) {
    for (var i = 0; i < closeGallery.length; i++) {
      closeGallery[i].addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('.page-wrap').classList.remove('slider-open');
      });
    }
  }

  let closeArtistsImg = document.querySelectorAll('.close-artist-and-maker');
  if (closeArtistsImg) {
    for (var i = 0; i < closeArtistsImg.length; i++) {
      // hover state
      closeArtistsImg[i].addEventListener('mouseover', function () {
        for (var i = 0; i < closeArtistsImg.length; i++) {
          closeArtistsImg[i].classList.add('hover');
        }
      });
      closeArtistsImg[i].addEventListener('mouseout', function () {
        for (var i = 0; i < closeArtistsImg.length; i++) {
          closeArtistsImg[i].classList.remove('hover');
        }
      });
    }
  }


  setupVideo();

  //let showImages = document.getElementById("images");
  let allImages = document.querySelector(".details.clickable .all-images");
  let openInfo = document.querySelector(".details.clickable .open-info");
  let openFilm = document.querySelector(".details.clickable .open-film");
  let projectWrap = document.getElementById("project-wrap");

  // if (showImages) {
  //   showImages.addEventListener("click", function(event) {
  //     projectWrap.className = "project-wrap";
  //     stopVideo();
  //   });
  // }
  if (allImages) {
    allImages.addEventListener("click", function (event) {
      projectWrap.classList.toggle('thumbs-open');
      projectWrap.classList.remove('info-open', 'film-open');
      stopVideo();
    });
  }
  if (openInfo) {
    openInfo.addEventListener("click", function (event) {
      projectWrap.classList.toggle('info-open');
      projectWrap.classList.remove('thumbs-open', 'film-open');
      //projectWrap.className = "project-wrap info-open";
      stopVideo();
    });
  }
  if (openFilm) {
    openFilm.addEventListener("click", function (event) {
      if (projectWrap.classList.contains('film-open')) {
        projectWrap.className = "project-wrap";
        stopVideo();
      } else {
        projectWrap.className = "project-wrap film-open";
        video = document.getElementById("video");
        video.play();
      }
    });
  }

  pagesLayout();
  //peopleTitle();
  window.addEventListener("resize", function () {
    pagesLayout();
    //peopleTitle();
  });


  projectGallery();


  document.addEventListener("resize", function () {
    updateSlideCounter();
  });
  let projectSlider = document.getElementById('project-slider');
  if (projectSlider) {
    projectSlider.addEventListener("scroll", function () {
      updateSlideCounter();
    });
    updateSlideCounter();
  }

  let subBtn = document.querySelector('a[href="#subscribe"]');
  if (subBtn) {
    subBtn.addEventListener('click', function (e) {
      e.preventDefault();
      document.body.classList.toggle('subscribe-open');
    });
  }
  if(window.location.hash === '#subscribe'){
    document.body.classList.add('subscribe-open');
  }


  // subscribe form //
  const subForm = document.getElementById('subscribe');
  if (subForm) {
    subForm.addEventListener('submit', function (e) {
      e.preventDefault();

      // Check for spam
      if (document.getElementById('js-validate-robot').value !== '') { return false }

      // Get url for mailchimp
      var url = this.action.replace('/post?', '/post-json?');

      // Add form data to object
      var data = '';
      var inputs = this.querySelectorAll('input');
      for (var i = 0; i < inputs.length; i++) {
        data += '&' + inputs[i].name + '=' + encodeURIComponent(inputs[i].value);
      }

      // Create & add post script to the DOM
      var script = document.createElement('script');
      script.src = url + data;
      document.body.appendChild(script);

      // Callback function
      var callback = 'callback';
      window[callback] = function (data) {

        // Remove post script from the DOM
        delete window[callback];
        document.body.removeChild(script);

        // Display response message
        document.getElementById('js-subscribe-response').innerHTML = data.msg
      };
    });
  }

  let overlaySlider = document.querySelector('.overlay-slider');
  if (overlaySlider) {
    overlaySlider.addEventListener("click", function (event) {
      document.querySelector('.page-wrap').classList.remove('slider-open');
    });
  }
}

init();


// const options = {
//     linkSelector:
//       'a[href^="' + window.location.origin + '"]:not([data-no-swup]), a[href^="/"]:not([data-no-swup]), a[href^="#"]:not([data-no-swup]), a[href^="' + window.location.origin + '"]:not([data-subpage-swup]), a[href^="/"]:not([data-subpage-swup]), a[href^="#"]:not([data-subpage-swup])',
//       containers: ["#swup"]
// };


const swup = new Swup({
  debug: true,
  containers: ['.swup-menu', '.swup-main', '.page-title'],
  plugins: [
    new SwupBodyClassPlugin(),
    new SwupGaPlugin(),
    // new SwupFragmentPlugin({ 
    //   rules:[
    //     {
    //       from: ["/recognition/press"],
    //       to: ["/press/:id"],
    //       containers: ["#press-slider"],
    //       //name: "press"
    //     },
    //     {
    //       from: ["/press/:id"],
    //       to: ["/recognition/press"],
    //       containers: ["#press-slider"],
    //       //name: "press"
    //     }
    //   ] 
    // })
  ]
});

// const subPageOptions = {
//     linkSelector:'#secondary-nav a',
//     containers: ["#swup-subpages"],
//     animationSelector: '[class*="subpage-transition-"]'
// };

// const swupSubPages = new Swup(subPageOptions);

// function getCookie(cname) {
//   var name = cname + "=";
//   var decodedCookie = decodeURIComponent(document.cookie);
//   var ca = decodedCookie.split(';');
//   for (var i = 0; i < ca.length; i++) {
//     var c = ca[i];
//     while (c.charAt(0) == ' ') {
//       c = c.substring(1);
//     }
//     if (c.indexOf(name) == 0) {
//       return c.substring(name.length, c.length);
//     }
//   }
//   return "";
// }


swup.hooks.on('content:replace', (e) => {
  //console.log("replace:",e, e.fragmentVisit)
  //if(!e.fragmentVisit.name == "press"){
  if(!e.fragmentVisit){  
    init()
    document.querySelector('main').scrollTo(0, scrollValues[window.location.href]);
  }
});  
let scrollValues = {};

swup.hooks.on('page:view', () => {
  window.ga('set', 'title', document.title);
  window.ga('set', 'page', window.location.pathname + window.location.search);
  window.ga('send', 'pageview');
}); 

swup.hooks.on("link:click", (e) => {
  //console.log("click:",e, e.fragmentVisit)
    //scrollValues[window.location.href] = window.scrollY;
    scrollValues[window.location.href] = document.querySelector('main').scrollTop;
  //}
});

// document.addEventListener("swup:contentReplaced", event => {
//   //setTimeout(function () {
//   //window.scrollTo(0, scrollValues[window.location.href]);
//   document.getElementById('main').scrollTo(0, scrollValues[window.location.href]);
//   //}, 0);
//   window.ga('set', 'title', document.title);
//   window.ga('set', 'page', window.location.pathname + window.location.search);
//   window.ga('send', 'pageview');
//   //customCursor.removeAttribute("data-hover");
// });







class StickyImage extends HTMLElement {
  constructor() {
      super();
  }
  setStickyImg(){
    const descHeight = this.querySelector('.desc').clientHeight
    if(window.innerWidth < 750){
      this.style.height = descHeight + window.innerHeight + 'px'
      this.style.padding = ''
    }else{
      this.style.height = ''
      // const elStyles = window.getComputedStyle(el)
      // const padding = parseInt(elStyles.getPropertyValue('padding-top'))
      const padding = document.querySelector('.site-header').clientHeight
      if((descHeight + (padding * 2)) >= window.innerHeight){
        this.classList.add('fixed-img')
        const newPadding = (window.innerHeight - this.querySelector('.thumb img').clientHeight) * .5
        this.style.padding = newPadding + 'px 0'
      }else{
        this.classList.remove('fixed-img')
        this.style.padding = ''
      }
    }
  }
  connectedCallback(){
    this.setStickyImg()
    window.addEventListener('resize',this.setStickyImg.bind(this))
  }
  disconnectedCallback() {
    window.removeEventListener('resize',this.setStickyImg)
  }
}
window.customElements.define('sticky-image', StickyImage) 




// class PressSlider extends HTMLElement {
//   constructor() {
//       super();
//   }
//   connectedCallback(){

//       let slider = new Swiper(this, {
//         modules: [EffectFade, Pagination, Navigation],
//         speed: 600,
//         effect: 'fade',
//         fadeEffect: {
//           crossFade: true
//         },
//         loop: true,
//         lazy: {
//           loadPrevNext: true,
//         },
//         navigation: {
//           nextEl: ".swiper-button-next",
//           prevEl: ".swiper-button-prev",
//         },
//         pagination: {
//           el: ".swiper-pagination",
//           type: "fraction",
//         },
//       })
//       // this.querySelectorAll('.swiper-button-prev').forEach((prevBtn)=>{
//       //   prevBtn.addEventListener('click',()=>{
//       //     slider.slidePrev()
//       //   })
//       // })
//       // this.querySelectorAll('.swiper-button-next').forEach((nextBtn)=>{
//       //   nextBtn.addEventListener('click',()=>{
//       //     slider.slideNext()
//       //   })
//       // })

//   }
// }
// window.customElements.define('press-slider', PressSlider) 




class PressCard extends HTMLElement {
  constructor() {
      super();
  }
  connectedCallback(){
    const links = this.querySelectorAll('a')
    const slides = this.dataset.slides
    links.forEach(link => {
      if(slides){
        link.addEventListener('click',(e)=>{
          e.preventDefault()
          let slidesHtml = `
            <div class="press-slider-wrap" style="opacity:0">
              <div class="close-bg close-press-slider"></div>
              <div class="modal-wrap"> 
                <button class="close close-press-slider">Close</button>
                <div class="press-slider swiper">
                  <div class="swiper-wrapper">`
                    slides.split(',').forEach(slide => {
                      slidesHtml += `<div class="swiper-slide"><img src="${slide}" loading="lazy"></div>`
                    })
                    slidesHtml += `
                  </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
              </div>  
            </div>`
    
          document.body.insertAdjacentHTML("beforeend",slidesHtml)

          const pressSliderWrap = document.querySelector('.press-slider-wrap')

          const fadeIn = pressSliderWrap.animate({
            opacity: [0, 1]
          }, {
              duration: 200,
              easing: 'linear'
          });
          fadeIn.onfinish = () => {
            pressSliderWrap.style.opacity = ''
          }
    
          let pressSlider = new Swiper(document.querySelector('.press-slider'), {
            modules: [EffectFade, Pagination, Navigation],
            speed: 600,
            effect: 'fade',
            fadeEffect: {
              crossFade: true
            },
            loop: true,
            lazy: {
              loadPrevNext: true,
            },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
            pagination: {
              el: ".swiper-pagination",
              type: "fraction",
            },
          })

          const closePressSliders = document.querySelectorAll('.close-press-slider')
          closePressSliders.forEach(close => {
            close.addEventListener('click',()=>{
              const fadeOut = pressSliderWrap.animate({
                opacity: [1, 0]
              }, {
                  duration: 200,
                  easing: 'linear'
              });
              fadeOut.onfinish = () => {
                  pressSliderWrap.remove()
              }
            })  
          })
        })
      }  
    })
  }
}
window.customElements.define('press-card', PressCard) 
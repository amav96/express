const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
 const submitBtn = document.querySelector(".submit");
const progressText = [...document.querySelectorAll(".step p")];
const progressCheck = [...document.querySelectorAll(".step .check")];
const bullet = [...document.querySelectorAll(".step .bullet")];
var max = 4;
var current = 1;




nextBtnFirst.addEventListener("click", function(e){
  e.preventDefault();
  nextFirstPage()
});

nextBtnSec.addEventListener("click", function(e){
  
  e.preventDefault();
  nextSecondFirst()
});

// nextBtnThird.addEventListener("click", function(e){
//   e.preventDefault();
//   nextThirdPage()

//  });

//  submitBtn.addEventListener("click", function(e){
//   e.preventDefault();
//     sendData()
  // setTimeout(function(){
   //   alert("Your Form Successfully Signed up");
   //   location.reload();
   // },800);
  // });

  prevBtnSec.addEventListener("click", function(e){
  
    e.preventDefault();
    prevSecondPage()
  });
  prevBtnThird.addEventListener("click", function(e){
    
    e.preventDefault();
    prevThirdPage()
  });
  prevBtnFourth.addEventListener("click", function(e){
    
    e.preventDefault();
    prevFourPage()
  });




 function nextFirstPage(){
  slidePage.style.marginLeft = "-25%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
 }
  
 function nextSecondFirst(){
  slidePage.style.marginLeft = "-50%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
 }

function nextThirdPage(){
  slidePage.style.marginLeft = "-75%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
}

  // function sendData(){
  //   bullet[current - 1].classList.add("active");
  //   progressCheck[current - 1].classList.add("active");
  //   progressText[current - 1].classList.add("active");
  //   current += 1;
  // }


    function prevSecondPage(){
      slidePage.style.marginLeft = "0%";
      bullet[current - 2].classList.remove("active");
      progressCheck[current - 2].classList.remove("active");
      progressText[current - 2].classList.remove("active");
      current -= 1;
    } 

    function prevThirdPage(){
      slidePage.style.marginLeft = "-25%";
      bullet[current - 2].classList.remove("active");
      progressCheck[current - 2].classList.remove("active");
      progressText[current - 2].classList.remove("active");
      current -= 1;
    }

    function prevFourPage(){
      slidePage.style.marginLeft = "-50%";
      bullet[current - 2].classList.remove("active");
      progressCheck[current - 2].classList.remove("active");
      progressText[current - 2].classList.remove("active");
      current -= 1;
    }
 




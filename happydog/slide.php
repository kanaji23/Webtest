<div class="slide_area" onmouseover="pause();" onmouseout="resume();">
  <div class="mySlides fade" style="display:none;">
    <img src="/happydog/ref/ad_1.jpg" style="width:100%; height:300px">
  </div>
  <div class="mySlides fade" style="display:none;">
    <img src="/happydog/ref/ad_2.jpg" style="width:100%; height:300px">
  </div>
  <div class="mySlides fade" style="display:none;">
    <img src="/happydog/ref/ad_3.jpg" style="width:100%; height:300px">
  </div>

  <a class="prev" onclick="minusSlides()">&#10094;</a>
  <a class="next" onclick="plusSlides()">&#10095;</a>

  <div class="dots" style="text-align:center;">
    <span class="dot" onclick="currentSlide(0)"></span>
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
  </div>

</div>
<br>


<script>


var slideIndex = 0;
var fs;
var slides = document.getElementsByClassName("mySlides");
function showSlides() {
  var i;

  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" activedot", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " activedot";
  clearTimeout(fs);
  fs = setTimeout(showSlides, 2000); // Change image every 2 seconds
  console.log(slideIndex);
}

showSlides();

function currentSlide(n) {
  clearTimeout(fs);
  slideIndex = n;
  showSlides();
  pause();
}

function pause()
{
  clearTimeout(fs);
  console.log("pause");
}

function resume()
{
  console.log("resume");
  slideIndex -= 1;
  // slideIndex +=n;
  if (slideIndex > slides.length) {slideIndex = 1;}
  if (slideIndex < 0) {slideIndex = slides.length - 1;}
  showSlides();

}


function plusSlides()
{
  // slideIndex +=n;
  // if (slideIndex > slides.length) {slideIndex = 1;}
  // if (slideIndex < 1) {slideIndex = slides.length;}
  clearTimeout(fs);
  showSlides();
  pause();
}

function minusSlides()
{
  slideIndex -= 2;
  // slideIndex +=n;
  if (slideIndex > slides.length) {slideIndex = 1;}
  if (slideIndex < 0) {slideIndex = slides.length - 1;}
  clearTimeout(fs);
  showSlides();
  pause();
}


</script>

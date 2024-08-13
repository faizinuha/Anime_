const myslide = document.querySelectorAll('.myslider'),
      dot = document.querySelectorAll('.dot');
let counter = 3;
let timer = setInterval(autoslide, 2000); // Mulai timer untuk autoslide

slidefun(counter); // Tampilkan slide pertama

function autoslide() {
    counter++;
    slidefun(counter);
}

function plusSlides(n) {
    counter += n;
    slidefun(counter);
    resetTimer();
}

function currentSlide(n) {
    counter = n;
    slidefun(counter);
    resetTimer();
}

function resetTimer() {
    clearInterval(timer);
    timer = setInterval(autoslide, 8000);
}

function slidefun(n) {
    let i;
    // Sembunyikan semua slides
    for (i = 0; i < myslide.length; i++) {
        myslide[i].style.display = "none";
    }
    // Hapus class 'active' dari semua dot
    for (i = 0; i < dot.length; i++) {
        dot[i].className = dot[i].className.replace(' active', '');
    }
    // Reset counter jika melewati batas jumlah slide
    if (n > myslide.length) { 
        counter = 1;
    }
    // Jika counter kurang dari 1, kembali ke slide terakhir
    if (n < 1) { 
        counter = myslide.length;
    }
    // Tampilkan slide yang aktif dan tambahkan class 'active' ke dot yang sesuai
    myslide[counter - 1].style.display = "block";
    dot[counter - 1].className += " active";
}

// GLIDER
// new Glider(document.querySelector('.glider'), {

// })

document.querySelectorAll('.glider').forEach(function(glider) {
  new Glider(glider, {
      slidesToShow: 4,
      slidesToScroll: 4,
      draggable: true,
      dots: '.dots',
      arrows: {
          prev: '.glider-prev',
          next: '.glider-next'
      }
  });
});

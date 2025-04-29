document.querySelectorAll('.carousel').forEach(carousel => {
  const inner = carousel.querySelector('.carousel-inner');
  const items = carousel.querySelectorAll('.carousel-item');
  const indicators = carousel.querySelectorAll('.indicator');
  const total = items.length;
  let currentIndex = 0;

  function showSlide(index) {
    if (index < 0) index = total - 1;
    if (index >= total) index = 0;
    
    inner.style.transform = `translateX(-${index * 100}%)`;
    currentIndex = index;
    
    indicators.forEach((dot, i) => {
      dot.classList.toggle('active', i === index);
    });
  }

  carousel.querySelector('.prev').addEventListener('click', () => {
    showSlide(currentIndex - 1);
  });

  carousel.querySelector('.next').addEventListener('click', () => {
    showSlide(currentIndex + 1);
  });

  indicators.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      showSlide(index);
    });
  });

  setInterval(() => {
    showSlide(currentIndex + 1);
  }, 3000);  
});

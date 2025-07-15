(function () {
  const collapseElementList = [].slice.call(document.querySelectorAll('.card-collapsible'));
  const expandElementList = [].slice.call(document.querySelectorAll('.card-expand'));


  // Collapsible card
  // --------------------------------------------------------------------
  if (collapseElementList) {
    collapseElementList.map(function (collapseElement) {
      collapseElement.addEventListener('click', event => {
        event.preventDefault();
        // Collapse the element
        new bootstrap.Collapse(collapseElement.closest('.card').querySelector('.collapse'));
        // Toggle collapsed class in `.card-header` element
        collapseElement.closest('.card-header').classList.toggle('collapsed');
        // Toggle class ti-chevron-down & ti-chevron-right
        Helpers._toggleClass(collapseElement.firstElementChild, 'ti-chevron-down', 'ti-chevron-right');
      });
    });
  }


  // Card Toggle fullscreen
  // --------------------------------------------------------------------
  if (expandElementList) {
    expandElementList.map(function (expandElement) {
      expandElement.addEventListener('click', event => {
        event.preventDefault();
        // Toggle class ti-arrows-maximize & ti-arrows-minimize
        Helpers._toggleClass(expandElement.firstElementChild, 'ti-arrows-maximize', 'ti-arrows-minimize');

        expandElement.closest('.card').classList.toggle('card-fullscreen');
      });
    });
  }

  // Toggle fullscreen on esc key
  document.addEventListener('keyup', event => {
    event.preventDefault();
    //Esc button
    if (event.key === 'Escape') {
      const cardFullscreen = document.querySelector('.card-fullscreen');
      // Toggle class ti-arrows-maximize & ti-arrows-minimize

      if (cardFullscreen) {
        Helpers._toggleClass(
          cardFullscreen.querySelector('.card-expand').firstChild,
          'ti-arrows-maximize',
          'ti-arrows-minimize'
        );
        cardFullscreen.classList.toggle('card-fullscreen');
      }
    }
  });

})();


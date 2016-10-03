jQuery(window).load(function() {

/*
var elem = document.querySelector('.archive');
var msnry = new Masonry( elem, {
  // options
  itemSelector: 'article',
  columnWidth: 200
});
*/

jQuery('.archive-list').masonry({
  // options
  itemSelector: 'article'
  //columnWidth: 200
});


jQuery(function(){
  // bind change event to select
  jQuery('.product-cats select').on('change', function () {
      var url = jQuery(this).val(); // get selected value
      if (url) { // require a URL
          window.location = url; // redirect
      }
      return false;
  });
});




});

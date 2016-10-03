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

});

$(function(){

  // フッターを最下部に固定
  let $ftr = $('footer');
  if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
    $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight() - 40) +'px; width:100vw' });
  };

});
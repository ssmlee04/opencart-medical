<ul>
	<button>ssss</button>
  <li><strong>list</strong> item 1 - one strong tag</li>
  <li><strong>list</strong> item <strong>2</strong> -
    two <span>strong tags</span></li>
  <li>list item 3</li>
  <li>list item 4</li>
  <li>list item 5</li>
  <li>list item 6</li>
</ul>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script type="text/javascript">

$('button').on('click', function(){


$.ajax({
  url: 'test2.php',
  type: 'POST',
  dataType: 'json',
  complete: function(xhr, textStatus) {
    //called when complete
  },
  success: function(json) {
    
  },
  error: function(xhr, textStatus, errorThrown) {
    //called when there is an error
    console.log(xhr, textStatus, errorThrown);
  }
});

})
</script>
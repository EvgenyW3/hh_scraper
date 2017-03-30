<?php 
  
include_once('simple_html_dom.php');



$html = file_get_html('https://www.laurea.fi/opiskelu-ja-hakeminen/opintojen-kulku/professional-summer-school');
$elem = $html->find('div[id=accordion-field]', 0);


echo '<script src="https://code.jquery.com/jquery-1.10.2.js"></script>';
echo '<style type="text/css">
	    .custom-laureaTable-0 {
	        display: none;
	    }

	    #accordion-field h2.custom-laureaElement-LaureaAccordionHeading {
		    cursor: pointer;
		    cursor: hand;
		    background-repeat: no-repeat;
		    background-repeat-x: no-repeat;
		    background-repeat-y: no-repeat;
		    line-height: 48px;
			background-color: #e7e9ec;
		}
		.custom-laureaElement-LaureaAccordionHeading span {
   			color: black !important;
		}
		.wrap h2{
			text-align: left !important;
		}
		.wrap > div > p{
			text-align: left !important;
		}
      </style>';

foreach($elem->find('h2[class=custom-laureaElement-LaureaAccordionHeading]') as $key => $headings) {
	$headings->{'id'} = 'trigger_'.$key;
	$headings->outertext = '</div><div class="wrap">' . $headings->outertext . '<div id="accordion_'.$key.'" style="display:none;">';
	echo '<script>
		$( document ).ready(function() {
			$("body").on("click", "#trigger_'.$key.'", function(){
				$("#accordion_'.$key.'").toggle();
			});
		});
		</script>';
}

foreach ($elem->find('h2[class=custom-laureaElement-LaureaHeading2]') as $key => $exceptions) {
	$exceptions->outertext = '</div><div class="wrap">' . $exceptions->outertext . '<div id="exception'.$key.'" style="display:block;">';
}

echo $elem;

?>
var przes = Fx.Transitions.bounceOut;
var dlugosc = 100;
var napisgora ="Open";
var napisdol = "Close";

window.onDomReady(function(){rozwin()});

rozwin=function()
{
	$('paneltop').state=0;
	$('paneltop').fx=$('paneltop').effect('top',{duration:800,przes:przes});
	$('paneltop').fx.set(-dlugosc);
	$('panelmodul').style.visibility="visible";
	$('paneltlo').style.height=dlugosc-1+'px';
	$('panelnapis').lastChild.nodeValue=napisgora;
	$('panelnapist').addEvent('click',function()
	{
		if($('paneltop').state==1) {
			
			$('paneltop').state=0;
			$('paneltop').fx.start(0,-dlugosc);
			$('panelnapis').lastChild.nodeValue=napisgora
		}
		else {
			
			$('paneltop').state=1;
			$('paneltop').fx.start(-dlugosc,0);
			$('panelnapis').lastChild.nodeValue=napisdol
			}
	}
	)
};

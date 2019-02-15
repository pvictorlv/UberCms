/*
	Creador de Placas Grupos jQuery
	Autor: Joaquin A. (SoyJoaquin. / -Null-)
		Skype: SoyJoaquin.
		Twitter: JoakoM010
*/
var base = 1;
var bascol;
var basfinal = '01';
var cbase = '01';
var basetotal = 24;
var objetototal = 67;
var cero; 
var objetos = new Array(new Array(), new Array(), new Array(), new Array());

objetos[0]['obj'] = 1;
objetos[0]['result'] = '01';
objetos[0]['desac'] = true; 
objetos[0]['pos'] = 0;
objetos[0]['ant_pos'];
objetos[0]['color'] = '01';
objetos[0]['ant_color'];

objetos[1]['obj'] = 1;
objetos[1]['result'] = '01';
objetos[1]['desac'] = true; 
objetos[1]['pos'] = 0;
objetos[1]['ant_pos'];
objetos[1]['color'] = '01';
objetos[1]['ant_color'];

objetos[2]['obj'] = 1;
objetos[2]['result'] = '01';
objetos[2]['desac'] = true; 
objetos[2]['pos'] = 0;
objetos[2]['ant_pos'];
objetos[2]['color'] = '01';
objetos[2]['ant_color'];

objetos[3]['obj'] = 1;
objetos[3]['result'] = '01';
objetos[3]['desac'] = true;
objetos[3]['pos'] = 0;
objetos[3]['ant_pos'];
objetos[3]['color'] = '01';
objetos[3]['ant_color'];

$(document).ready(function(){
	$('#baseimg').css('background-image', 'url(sistemas/placas/base/'+basfinal+'.gif)');
	for(i=0;i<objetos.length;i++){
		if(objetos[i]['desac'] == true)
			$('#accimg-'+i).css('background-image', 'url(img/cancelar.gif)');
		else
			$('#accimg-'+i).css('background-image', 'url(sistemas/placas/templates/'+objetos[i]['result']+'.gif)');
		colorBase(cbase);
		cambiarPos(i, objetos[i]['pos']);
		cambiarColor(i, objetos[i]['color']);
	}
	$(verlink);
	
	$('div.imgprev.obj').click(function(){
		var op = $(this).attr('obj');
		if(objetos[op]['desac'] == false) {
			$(this).css('background-image', 'url(img/cancelar.gif)');
			objetos[op]['desac'] = true;
		}else{
			$(this).css('background-image', 'url(sistemas/placas/templates/'+objetos[op]['result']+'.gif)');
			objetos[op]['desac'] = false;
		}
		$(verlink);
	});
});
function cambiarBase(accion) {
	if(accion == 1)
		(base < basetotal) ? base++ : base = 1;
	else if(accion == 0)
		(base > 1) ? base-- : base = basetotal;
	(base <= 9) ? cero = '0' : cero = '';
	basfinal = cero + base;
	$('#baseimg').css('background-image', 'url(sistemas/placas/base/'+basfinal+'.gif)');
	$(verlink);
}
function colorBase(color) {
	cbase = color;
	if(!isNaN(bascol))
		$('#bascolor-'+bascol).removeClass('b_select');
	$('#bascolor-'+color).addClass('b_select');
	bascol = color;
	$(verlink);
}
function cambiarObjeto(accion, id) {
	if(accion == 1)
		(objetos[id]['obj'] < objetototal) ? objetos[id]['obj']++ : objetos[id]['obj'] = 1;
	else if(accion == 0)
		(objetos[id]['obj'] > 1) ? objetos[id]['obj']-- : objetos[id]['obj'] = objetototal;
	(objetos[id]['obj'] <= 9) ? cero = '0' : cero = '';
	objetos[id]['result'] = cero + objetos[id]['obj'];
	$('#accimg-'+id).css('background-image', 'url(sistemas/placas/templates/'+objetos[id]['result']+'.gif)');
	objetos[id]['desac'] = false;
	$(verlink);
}
function cambiarColor(id, color) {
	objetos[id]['color'] = color;
	if(!isNaN(objetos[id]['ant_color']))
		$('#bcolor-'+id+'-'+objetos[id]['ant_color']).removeClass('b_select');
	$('#bcolor-'+id+'-'+objetos[id]['color']).addClass('b_select');
	objetos[id]['ant_color'] = color;
	$(verlink);
}
function cambiarPos(id, pos) {
	if(pos <= 8 && pos >= 0)
		objetos[id]['pos'] = pos;
	if(!isNaN(objetos[id]['ant_pos']))
		$('#pos-'+id+'-'+objetos[id]['ant_pos']).removeClass('select');
	$('#pos-'+id+'-'+pos).addClass('select');
	objetos[id]['ant_pos'] = pos;
	$(verlink);
}
function verlink() {
	var finresult = new Array();
	for(i=0;i<objetos.length;i++){
		if(objetos[i]['desac'] == false)
			finresult[i] = "s" + objetos[i]['result']+objetos[i]['color']+objetos[i]['pos'];
		else
			finresult[i] = "";
	}
	var milink = "b" + basfinal + cbase + "X" + finresult[0] + finresult[1] + finresult[2] + finresult[3];
	$("textarea#placafinal").val(milink);
	$('#placafinal').attr('src','habbo-imaging/badge.php?badge='+milink); 

}
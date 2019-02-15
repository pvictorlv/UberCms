var jjLoader = {
	'maxStep': 0,
	'currentStep': 1,
	'isInit': false,
	'interval': null,
	'init': function(_wrapperId, _maxStep, _imageUrl, _backgroundUrl){
		jjLoader.maxStep = _maxStep;
		
		var wrapper = document.getElementById(_wrapperId);
		
		wrapper.innerHTML += '<div id="wrapperLoader" style="background: #000000 url('+_backgroundUrl+') left center no-repeat; position: absolute; z-index: 9999999; top: 0; left: 0; width: 100%; height: 100%;">'+
		'<div style="width: 240px; height: 125px; padding: 5px; border-radius: 10px; background: rgba(0, 0, 0, 0.7) url('+_imageUrl+') center 15px no-repeat; position: absolute; left: 50%; top: 50%; margin-top: -65px; margin-left: -125px;">'+
		'<div id="wrapperLoaderText" style="margin-top: 60px; margin-bottom: 10px; text-align: center; font-family: Arial; color: #FFFFFF; font-size: 10px;">Conectando.. 0%</div>'+
		'<div style="border-radius: 1px; border: 1px solid #FFFFFF; background-color: rgba(0, 0, 0, 0.6); padding: 1px; margin-left: 20px; width: 200px; height: 17px">'+
		'<div id="wrapperLoaderProgress" style="background-color: #8CA1AD; height: 17px; width: 0;">'+
		'<div style="background-color: #BACAD3; height: 9px; width: 100%;">'+
		'</div></div></div></div>';
		
		jjLoader.interval = window.setInterval(jjLoader.IntervalUpdate, 10);
		
		jjLoader.isInit = true;
		return true;
	},
	'progressNow': 0,
	'progress': 0,
	'IntervalUpdate': function(){
		if (jjLoader.progressNow >= jjLoader.progress || jjLoader.progressNow >= 100)
		{
			return;
		}
		
		jjLoader.progressNow += 2;
		
		var wrapperLoaderProgress = document.getElementById('wrapperLoaderProgress');
		wrapperLoaderProgress.style.width = jjLoader.progressNow +'%';
	},
	'doUpdate': function(_text){
		if (!jjLoader.isInit)
		{
			return false;
		}
		
		jjLoader.currentStep++;
		jjLoader.progress = Math.round((100 / jjLoader.maxStep) *jjLoader.currentStep);
		
		if (jjLoader.progress > 100)
		{
			jjLoader.progress = 100;
		}
		
		jjLoader.updateText(_text);
		
		return true;
	},
	'updateText': function(_text){
		if (!jjLoader.isInit)
		{
			return false;
		}
		
		var text = '';
		if (jjLoader.progress > 0 && jjLoader.progress < 26)
		{
			text = "Cargando usuarios..";
		} 
		else if (jjLoader.progress > 25 && jjLoader.progress < 50) 
		{
			text = "Configurando Habbos..";
		} 
		else if (jjLoader.progress > 49 && jjLoader.progress < 77) 
		{
			text = "Cargando datos..";
		} 
		else if (jjLoader.progress > 76 && jjLoader.progress < 93) 
		{
			text = "Preparando salas..";
		} 
		else if (jjLoader.progress > 92 && jjLoader.progress < 101) 
		{
			text = "¡Bienvenido a Revolution!";
		}
		
		var wrapperLoaderText = document.getElementById('wrapperLoaderText');
		wrapperLoaderText.innerHTML = text+' '+jjLoader.progress+'%';
		
		return true;
	},
	'finish': function(){
		if (!jjLoader.isInit)
		{
			return false;
		}

		var wrapperLoader = document.getElementById('wrapperLoader');
		wrapperLoader.parentNode.removeChild(wrapperLoader);
		
		window.clearInterval(jjLoader.interval);

		return true;
	}
};
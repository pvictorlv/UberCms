<div class="habblet-container minimail" id="mail">		
						<div class="cbb clearfix blue "> 
	
							<h2 class="title">Minhas mensagens						</h2>
						<div id="minimail"> 
    <div class="minimail-contents"> 
	<?php include('minimail-tabcontent.php'); ?>
	</div> 
	<div id="message-compose-wait"></div> 
    <form style="display: none" id="message-compose"> 
        <div>Para</div> 
        <div id="message-recipients-container" class="input-text" style="width: 426px; margin-bottom: 1em"> 
        	<input type="text" value="" id="message-recipients" /> 
        	<div class="autocomplete" id="message-recipients-auto"> 
        		<div class="default" style="display: none;">Nome de seu amigo</div>
        		<ul class="feed" style="display: none;"></ul> 
        	</div> 
        </div> 
        <div>Assunto<br/>
        <input type="text" style="margin: 5px 0" id="message-subject" class="message-text" maxlength="100" tabindex="2" /> 
        </div> 
        <div>Mensagem<br/>
        <textarea style="margin: 5px 0" rows="5" cols="10" id="message-body" class="message-text" tabindex="3"></textarea> 
        </div> 
        <div class="new-buttons clearfix"> 
            <a href="#" class="new-button preview"><b>Vista previa</b><i></i></a> 
            <a href="#" class="new-button send"><b>Enviar</b><i></i></a> 
        </div> 
    </form>	
</div> 
<script type="text/javascript"> 
	L10N.put("minimail.compose", "Escrever").put("minimail.cancel", "Cancelar")
		.put("bbcode.colors.red", "Vermelho").put("bbcode.colors.orange", "Laranja")
    	.put("bbcode.colors.yellow", "Amarelo").put("bbcode.colors.green", "Verde")
    	.put("bbcode.colors.cyan", "Ciano").put("bbcode.colors.blue", "Azul")
    	.put("bbcode.colors.gray", "Cinza").put("bbcode.colors.black", "Preto")
    	.put("minimail.empty_body.confirm", "Tem certeza que deseja enviar uma mensagem vazia?")
    	.put("bbcode.colors.label", "Cores").put("linktool.find.label", " ")
    	.put("linktool.scope.habbos", "Habbo").put("linktool.scope.rooms", "Sala")
    	.put("linktool.scope.groups", "Grupo").put("minimail.report.title", "Den�nciar a mensagem.");
 
    L10N.put("date.pretty.just_now", "Agora");
    L10N.put("date.pretty.one_minute_ago", "Faz um minutos");
    L10N.put("date.pretty.minutes_ago", "aproximadamente {0} minutos");
    L10N.put("date.pretty.one_hour_ago", "faz 1 hora");
    L10N.put("date.pretty.hours_ago", "faz {0} horas");
    L10N.put("date.pretty.yesterday", "ontem");
    L10N.put("date.pretty.days_ago", "faz {0} dias");
    L10N.put("date.pretty.one_week_ago", "faz 1 semana");
    L10N.put("date.pretty.weeks_ago", "faz {0} semanas");
	new MiniMail({ pageSize: 10, 
	   total: 0, 
	   friendCount: 3, 
	   maxRecipients: 50, 
	   messageMaxLength: 20, 
	   bodyMaxLength: 4096,
	   secondLevel: false});
</script>
	
						
							
					</div> 
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 
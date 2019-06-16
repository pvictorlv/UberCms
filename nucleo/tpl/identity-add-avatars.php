<body id="embedpage"> 
<div id="overlay"></div> 

<div id="container"> 

	<script type="text/javascript">
	
		document.observe("dom:loaded", function() {

        $(document.body).addClassName("js");

        $("habbo-name").focus();

        var checkHandler = function(e) {

            Event.stop(e);

            new Ajax.Updater("name-field-container", "/identity/add_avatar", {

                parameters: { checkNameOnly: "true", "bean.avatarName": $F("habbo-name")},

                onComplete: function() {

                    if ($("name-field-container").select(".state-error").length != 0) {

                        $("habbo-name").focus();

                    }
                }

            });

        };

        Event.observe($("name-field-container"), "click", Event.delegate({

            '#check-name-btn > *' : checkHandler,

            '#check-name-btn' : checkHandler,

            '#name-suggestion-list a' : function(e) {

                Event.stop(e);

                new Ajax.Updater("name-field-container", "/identity/add_avatar", {

                    parameters: { checkNameOnly: "true", "bean.avatarName": Event.element(e).innerHTML },

                    onComplete: function() {

                        if ($("name-field-container").select(".state-error").length != 0) {

                            $("habbo-name").focus();

                        }
                    }

                });

            }

        }));


        if ($("popup-link")) {

            Event.observe($("popup-link"), "click", function(e) {

                Event.stop(e);

                window.open($("popup-link").href, null, "toolbar=no,location=yes,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=540,height=500");

            });

        }



    });

	
		function changelook(look, gender)
		{
			document.getElementById('changes_look').value = look;
			document.getElementById('preview_look').src = "https://habbo.city/habbo-imaging/avatarimage?figure=" + look;
			document.getElementById('changes_gender').value = gender;
		}
	
	</script>
 
  <div id="add-avatar">

    <div class="add-avatar-container clearfix">

        <div class="title">

          <span class="habblet-close"></span>

          <h1>Adicionar avatar</h1>

        </div>

        <div id="content">

            <a id="back-link" href="%www%/identity/avatars">&laquo; Voltar a seus Habbo's</a>

            <form action="%www%/identity/add_avatar_add" name="addavatarform" id="add-avatar-form" method="post">

								%errors%

                <!--<a href="%www%/identity/link_account" id="account-link">Klik hier als je een bestaande Habbo wilt toevoegen</a>--!>



            <input type="hidden" name="__app_key" value="21DA38528038E012D4EA936A06357B24.resin-fe-7" />
						<input id="changes_look" type="hidden" name="bean.look" value="hr-545-45.hd-620-4.ch-630-63.lg-3116-64-1315.sh-725-62.he-1608.ca-1801-73.wa-2001,s-0.g-1.d-4.h-4.a-0" />
						<input id="changes_gender" type="hidden" name="bean.gender" value="F" />

            <div id="name-field-container">

                <div class="field field-habbo-name">

                  <label for="habbo-name">Nome habbo</label>

                  <input type="text" id="habbo-name" size="32" value="" name="bean.avatarName" class="text-field" maxlength="32"/>

                    <div id="name-suggestions">

                    </div>

                  <p class="help">Digite seu novo nome habbo.</p>

                </div>

            </div>

            <div id="avatar-field-container" class="clearfix">

                <div id="selected-avatar">

                    <h3>Visualizar</h3>

                        <img id="preview_look" src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-545-45.hd-620-4.ch-630-63.lg-3116-64-1315.sh-725-62.he-1608.ca-1801-73.wa-2001,s-0.g-1.d-4.h-4.a-0,09766cf8ab8cde0cf6102f936edde727.gif" width="64" height="110"/>

                </div>

                <div id="avatar-choices">

                    <h3>Meninas</h3>

                        <a href="javascript:changelook('hr-545-45.hd-600-4.ch-3113-75-76.lg-700-75.sh-725-74.he-1605-74.ca-1805-74', 'F');" class="female-avatar">

                            <img src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-545-45.hd-600-4.ch-3113-75-76.lg-700-75.sh-725-74.he-1605-74.ca-1805-74,s-1.g-1.d-4.h-4.a-0,e4fc1efae7f7fd6c2be8d464992175c2.gif" width="33" height="56"/>

                        </a>

                        <a href="javascript:changelook('hr-545-31.hd-620-4.ch-630-64.lg-720-78.sh-730-1315.he-1601.ca-1815-1315.wa-2001', 'F');" class="female-avatar">

                            <img src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-545-31.hd-620-4.ch-630-64.lg-720-78.sh-730-1315.he-1601.ca-1815-1315.wa-2001,s-1.g-1.d-4.h-4.a-0,ca3628918382019c8b6ac02f2b030633.gif" width="33" height="56"/>

                        </a>

                        <a href="javascript:changelook('hr-540-45.hd-600-4.ch-660-76.lg-720-64.sh-735-73.ha-1006.he-1605-62.ca-1815-73', 'F');" class="female-avatar">

                            <img src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-540-45.hd-600-4.ch-660-76.lg-720-64.sh-735-73.ha-1006.he-1605-62.ca-1815-73,s-1.g-1.d-4.h-4.a-0,2180c8d759e6818118d9e5625f14a369.gif" width="33" height="56"/>

                        </a>

                        <a href="javascript:changelook('hr-545-45.hd-600-3.ch-630-62.lg-696-64.sh-905-62.he-1610.ca-1815-64', 'F');" class="female-avatar">

                            <img src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-545-45.hd-600-3.ch-630-62.lg-696-64.sh-905-62.he-1610.ca-1815-64,s-1.g-1.d-4.h-4.a-0,13fc117708a54741235bf6e8eae2bd5c.gif" width="33" height="56"/>

                        </a>

                        <a href="javascript:changelook('hr-545-36.hd-600-3.ch-665-76.lg-710-64.sh-906-64.he-1608.ca-1815-75.wa-2011', 'F');" class="female-avatar">

                            <img src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-545-36.hd-600-3.ch-665-76.lg-710-64.sh-906-64.he-1608.ca-1815-75.wa-2011,s-1.g-1.d-4.h-4.a-0,d4af99b643a13c2a58a370fd545b450a.gif" width="33" height="56"/>

                        </a>



                    <h3>Meninos</h3>

                        <a href="javascript:changelook('hr-115-39.hd-209-2.ch-240-65.lg-285-64.sh-300-65.ha-1002-64.he-1605-65.ca-1804-64.wa-2001-.ea-1404-64', 'M');" class="male-avatar">

                            <img src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-115-39.hd-209-2.ch-240-65.lg-285-64.sh-300-65.ha-1002-64.he-1605-65.ca-1804-64.wa-2001-.ea-1404-64,s-1.g-1.d-4.h-4.a-0,0d7d40e1dddc58262bb68c76e567df5e.gif" width="33" height="56"/>

                        </a>

                        <a href="javascript:changelook('hr-889-34.hd-180-28.ch-235-62.lg-280-62.sh-908-62', 'M');" class="male-avatar">

                            <img src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-889-34.hd-180-28.ch-235-62.lg-280-62.sh-908-62,s-1.g-1.d-4.h-4.a-0,bb1d17bdf6c0149fb4c855ae5e33cd3c.gif" width="33" height="56"/>

                        </a>

                        <a href="javascript:changelook('hr-165-45.hd-208-2.ch-250-64.lg-285-82.sh-290-64', 'M');" class="male-avatar">

                            <img src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-165-45.hd-208-2.ch-250-64.lg-285-82.sh-290-64,s-1.g-1.d-4.h-4.a-0,8a0120d87fecd56989b2d59b6054ce05.gif" width="33" height="56"/>

                        </a>

                        <a href="javascript:changelook('hr-155-31.hd-180-2.ch-235-62.lg-275-62.sh-290-62.ha-1006.ea-1401-64', 'M');" class="male-avatar">

                            <img src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-155-31.hd-180-2.ch-235-62.lg-275-62.sh-290-62.ha-1006.ea-1401-64,s-1.g-1.d-4.h-4.a-0,6ce52f2826bc5dc3faca8587106ee4f9.gif" width="33" height="56"/>

                        </a>

                        <a href="javascript:changelook('hr-165-39.hd-180-2.ch-235-64.lg-280-82.sh-906-62.ha-1006', 'M');" class="male-avatar">

                            <img src="https://habbo.city/habbo-imaging/avatarimage?figure=hr-165-39.hd-180-2.ch-235-64.lg-280-82.sh-906-62.ha-1006,s-1.g-1.d-4.h-4.a-0,a07a560aeefe69b0a9790b88daceabd8.gif" width="33" height="56"/>

                        </a>                
                </div>

            </div>

            <br clear="all"/>

            <a href="javascript:document.addavatarform.submit();" class="new-button green-button" id="done-btn"><b>Criar seu habbo</b><i></i></a>

        </form>

        </div>

    </div>

    <div class="add-avatar-container-bottom"></div>

  </div> 
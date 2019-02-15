<script src="%www%/web-gallery/static/js/homeedit.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
    document.observe("dom:loaded", function () {
        //initView(%qryId%, <?php echo USER_ID; ?>);
    });
    function isElementLimitReached() {
        if (getElementCount() >= 200) {
            showHabboHomeMessageBox("Ya cuentas con el m�ximo n�mero de elementos para la p�gina. Elimina una etiqueta, una nota o un elemento para dejar espacio a uno nuevo.", "Error", "Cerrar");
            return true;
        }
        return false;
    }

    function cancelEditing(expired) {
        location.replace("/myhabbo/cancel/%qryId%" + (expired ? "?expired=true" : ""));
    }

    function getSaveEditingActionName() {
        return '/myhabbo/save';
    }

    function showEditErrorDialog() {
        var closeEditErrorDialog = function (e) {
            if (e) {
                Event.stop(e);
            }
            Element.remove($("myhabbo-error"));
            Overlay.hide();
        };
        var dialog = Dialog.createDialog("myhabbo-error", "", false, false, false, closeEditErrorDialog);
        Dialog.setDialogBody(dialog, '<p>Erro! Por favor, tente novamente.</p><p><a href="#" class="new-button" id="myhabbo-error-close"><b>Cerrar</b><i></i></a></p><div class="clear"></div>');
        Event.observe($("myhabbo-error-close"), "click", closeEditErrorDialog);
        Dialog.moveDialogToCenter(dialog);
        Dialog.makeDialogDraggable(dialog);
    }


    function showSaveOverlay() {
        var invalidPos = getElementsInInvalidPositions();
        if (invalidPos.length > 0) {
            $A(invalidPos).each(function (el) {
                Element.scrollTo(el);
                Effect.Pulsate(el);
            });
            showHabboHomeMessageBox("Ehh! Não pode fazer isso!", "Sentimos muito porém não pode colocar etiquetas aqui. Feche esta janela para continuar editando.", "Fechar");
            return false;
        } else {
            Overlay.show(null, 'Salvando');
            return true;
        }
    }
</script>
<script type="text/javascript" src="%www%/web-gallery/js/myhabbo-store.js"></script>
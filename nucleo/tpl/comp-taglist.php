
    <?php

    $tags = uberUsers::GetUserTags(USER_ID);
    $tagCount = count($tags);

    if ($tagCount > 0) {
        echo '<ul class="tag-list make-clickable">' . LB;

        foreach ($tags as $id => $tag) {
            echo '                    <li><a href="%www%/tag/' . $tag . '" class="tag" style="font-size:10px">' . $tag . '</a> 
                        <div class="tag-id" style="display:none">' . $id . '</div><a class="tag-remove-link"
                        title="Deletar"
                        href="#"></a></li>' . LB;
        }

        echo '</ul>' . LB;
    }

    if ($tagCount >= 20) {
        echo '<div class="add-tag-form">Limite de etiquetas atingido, deve remover algumas antes.</div>';
    } else {
        echo '<form method="post" action="/myhabbo/tag/add" onsubmit="TagHelper.addFormTagToMe();return false;" > 
    <div class="add-tag-form clearfix"> 
		<a  class="new-button" href="#" id="add-tag-button" onclick="TagHelper.addFormTagToMe();return false;"><b>Adicionar</b><i></i></a>
        <input type="text" id="add-tag-input" maxlength="20" style="float: right"/> 
        <em class="tag-question">';

        $possibleQuestions = Array();
        $possibleQuestions[] = 'Qual a sua comida favorita?';
        $possibleQuestions[] = 'Qual é o seu cantor favorito?';
        $possibleQuestions[] = 'Qual seu estilo musical?';
        $possibleQuestions[] = 'Qual a sua cor preferida?';
        $possibleQuestions[] = 'Qual é o seu canal de TV preferido?';


        $possibleQuestions[] = 'Quem é o seu ator preferido?';
        $possibleQuestions[] = 'Prefere esporte ou comida?';
        $possibleQuestions[] = 'Tem algum apelido?';
        $possibleQuestions[] = 'Qual a sua música preferida?';
        $possibleQuestions[] = 'Qual a sua época do ano preferida?';
        $possibleQuestions[] = 'Qual a sua banda preferida?';
        $possibleQuestions[] = 'Biquini ou maiô?';
        $possibleQuestions[] = 'Que instrumento você gostaria de tocar?';
        $possibleQuestions[] = 'Pizza, Hamburguer ou cachorro quente?';
        $possibleQuestions[] = 'Qual o seu esporte preferido?';
        $possibleQuestions[] = 'Para ir a festas se veste com...';
        $possibleQuestions[] = 'Qual o seu filme preferido?';
        $possibleQuestions[] = 'Qual gato é o mais exótico?';
        $possibleQuestions[] = 'Vermelho, azul, rosa ou outra cor?';
        $possibleQuestions[] = 'Jonas brothers, Demi Lovato ou Milley Cirus?';
        $possibleQuestions[] = 'Katty Perry ou Lady Gaga?';
        $possibleQuestions[] = 'Uma palavra que te defina';
        $possibleQuestions[] = 'Quem é o seu staff preferido?';
        $possibleQuestions[] = 'Faceook ou youtube?';
        $possibleQuestions[] = 'Rock, Pop ou Rap?';
        $possibleQuestions[] = 'Qual outro idioma fala?';
        $possibleQuestions[] = 'O melhor do mundo é...';
        $possibleQuestions[] = 'Qual o seu mobi preferido?';
        $possibleQuestions[] = 'Computador ou notebook?';
        $possibleQuestions[] = 'Habbo retro ou beta?';
        $possibleQuestions[] = 'Selena Gomez, Miranda ou outra atriz?';
        $possibleQuestions[] = 'Brasil ou Espanha?';
        $possibleQuestions[] = 'O Que vai ser quando crescer?';
        $possibleQuestions[] = 'Festa, computador ou televisão?';
        $possibleQuestions[] = 'A culpa é do mordomo?';


        echo $possibleQuestions[random_int(0, count($possibleQuestions) - 1)];


        echo '</em> 
    </div> 
    <div style="clear: both"></div> 
    </form>';
    }

    ?>


<script type="text/javascript">
    <?php if (!isset($habbletmode)) {
        echo 'document.observe("dom:loaded", function() {';
    } ?>
    TagHelper.setTexts({
        tagLimitText: "Limite de etiquetas atingido, remova alguma antes de continuar.",
        invalidTagText: "Etiqueta inválida.",
        buttonText: "OK"
    });

    <?php

    if (isset($habbletmode)) {
        echo 'TagHelper.bindEventsToTagLists();';
    } else {
        echo "TagHelper.init('" . USER_ID . '\');';
        echo '});';
    }

    ?>
</script> 
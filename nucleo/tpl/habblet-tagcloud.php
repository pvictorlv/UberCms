<div class="habblet box-content">

    <?php include("tagcloud.php"); ?>

    <div class="tag-search-form">
        <form name="tag_search_form" action="/tag/search" class="search-box">
            <input type="text" name="tag" id="search_query" value="" class="search-box-query" style="float: left"/>
            <a onclick="$(this).up('form').submit(); return false;" href="#" class="new-button search-icon"
               style="float: left"><b><span></span></b><i></i></a>
        </form>
    </div>
</div>
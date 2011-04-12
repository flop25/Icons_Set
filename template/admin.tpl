<div class="titrePage">
  <h2>{'iconset_configpage'|@translate}</h2>
</div>
<div id="themesContent">
  <fieldset>
    <legend>{'iconset_All_Themes'|@translate}</legend>
    <form action="" method="post" name="externe">
      <div class="themeBoxes"> {foreach from=$all_themes item=theme}
        <div class="themeBox">
          <div class="themeName">{$theme.name}</div>
          <div class="themeShot"><img src="{$theme.screenshot}" alt="screenshot"></div>
          <div class="themeActions">
            <div>
              <select name="{$theme.id}">
                <option value="">{'iconset_nothing'|@translate}</option>
				        {html_options output=$output values=$values selected=$theme.icon}
              </select>
            </div>
          </div>
          <!-- themeActions --> 
        </div>
        {/foreach} </div>
      <!-- themeBoxes -->
      <input name="envoi_config" type="hidden" value="iconset" />
      <input type="hidden" name="pwg_token" value="{$PWG_TOKEN}">
      <input type="submit" name="button2" id="button2" value="{'iconset_send'|@translate}" style=" width:100%" />
    </form>
  </fieldset>
  <fieldset>
    <legend>{'iconset_All_Icons'|@translate}</legend>
    <div class="iconBoxes"> {foreach from=$all_icons item=icons}
      <div class="iconBox" id="iconBox_{$icons.id}">
        <div class="iconName">{$icons.name}</div>
        <div class="iconShot">
          <ul>
            <li><a href="#" title="{'slideshow'|@translate}" class="pwg-state-default pwg-button" rel="nofollow"> <span class="pwg-icon pwg-icon-slideshow"> </span><span class="pwg-button-text">{'slideshow'|@translate}</span> </a></li>
            <li><a href="#" title="{'Show file metadata'|@translate}" class="pwg-state-default pwg-button" rel="nofollow"> <span class="pwg-icon pwg-icon-camera-info"> </span><span class="pwg-button-text">{'Show file metadata'|@translate}</span> </a></li>
            <li><a href="{$current.U_DOWNLOAD}" title="{'download this file'|@translate}" class="pwg-state-default pwg-button" rel="nofollow"> <span class="pwg-icon pwg-icon-save"> </span><span class="pwg-button-text">{'download'|@translate}</span> </a></li>
            <li><a href="#" title="{if $favorite.IS_FAVORITE}{'delete this photo from your favorites'|@translate}{else}{'add this photo to your favorites'|@translate}{/if}" class="pwg-state-default pwg-button" rel="nofollow"> <span class="pwg-icon pwg-icon-favorite-{if $favorite.IS_FAVORITE}del{else}add{/if}"> </span><span class="pwg-button-text">{'Favorites'|@translate}</span> </a></li>
            <li><a href="#" title="{'set as album representative'|@translate}" class="pwg-state-default pwg-button" rel="nofollow"> <span class="pwg-icon pwg-icon-representative"> </span><span class="pwg-button-text">{'representative'|@translate}</span> </a></li>
            <li><a href="#" title="{'Modify information'|@translate}" class="pwg-state-default pwg-button" rel="nofollow"> <span class="pwg-icon pwg-icon-edit"> </span><span class="pwg-button-text">{'edit'|@translate}</span> </a></li>
            <li><span class="pwg-state-disabled pwg-button"> <span class="pwg-icon pwg-icon-arrowstop-w">&nbsp;</span><span class="pwg-button-text">{'First'|@translate}</span> </span></li>
            <li><span class="pwg-state-disabled pwg-button"> <span class="pwg-icon pwg-icon-arrow-w">&nbsp;</span><span class="pwg-button-text">{'Previous'|@translate}</span> </span></li>
            <li><a href="#" title="{'Thumbnails'|@translate}" class="pwg-state-default pwg-button"> <span class="pwg-icon pwg-icon-arrow-n">&nbsp;</span><span class="pwg-button-text">{'Thumbnails'|@translate}</span> </a></li>
            <li><a href="#" title="{'Next'|@translate} : {$next.TITLE}" class="pwg-state-default pwg-button pwg-button-icon-right"> <span class="pwg-icon pwg-icon-arrow-e">&nbsp;</span><span class="pwg-button-text">{'Next'|@translate}</span> </a></li>
            <li><a href="#" title="{'Last'|@translate} : {$last.TITLE}" class="pwg-state-default pwg-button pwg-button-icon-right"> <span class="pwg-icon pwg-icon-arrowstop-e"></span><span class="pwg-button-text">{'Last'|@translate}</span> </a></li>
            <li>{strip}<a href="#" title="{'display all photos in all sub-albums'|@translate}" class="pwg-state-default pwg-button" rel="nofollow"> <span class="pwg-icon pwg-icon-category-view-flat"> </span><span class="pwg-button-text">{'display all photos in all sub-albums'|@translate}</span> </a>{/strip}</li>
            <li>{strip}<a href="#" title="{'return to normal view mode'|@translate}" class="pwg-state-default pwg-button"> <span class="pwg-icon pwg-icon-category-view-normal"> </span><span class="pwg-button-text">{'return to normal view mode'|@translate}</span> </a>{/strip}</li>
            <li>{strip}<a href="#" title="{'display a calendar by posted date'|@translate}" class="pwg-state-default pwg-button" rel="nofollow"> <span class="pwg-icon pwg-icon-calendar"> </span><span class="pwg-button-text">{'Calendar'|@translate}</span> </a>{/strip}</li>
            <li>{strip}<a href="#" title="{'display a calendar by creation date'|@translate}" class="pwg-state-default pwg-button" rel="nofollow"> <span class="pwg-icon pwg-icon-camera-calendar"> </span><span class="pwg-button-text">{'Calendar'|@translate}</span> </a>{/strip}</li>
            <li><a class="see_all" href="{$icons.icon_file}" title="{'iconset_seeall'|@translate}" > {'iconset_seeall'|@translate} </a></li>
          </ul>
        </div>
      </div>
      {/foreach} </div>
    <!-- themeBoxes -->
  </fieldset>
</div>
<!-- themesContent --> 